<?php

namespace App\Http\Controllers\Payment;

use App\Exceptions\Order\OrderException;
use App\Http\Controllers\Controller;
use App\Jobs\Order\NewOrderJob;
use App\Jobs\Order\OrderJob;
use App\Models\Accounter\Order;
use App\Models\Accounter\Wallet;
use App\Models\Accounter\WalletTransaction;
use App\Models\Accounter\ZarinpalResponse;
use App\OrderService;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Deprecated;
use Throwable;

class PaymentController extends Controller
{
    public function __construct(
        //        private readonly ZarinpalService $zarinpalService,
        private readonly OrderService $orderService
    ) {}

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws OrderException|Throwable
     */
    #[Deprecated(reason: 'This app uses a Request - Admin approve system. Not a payment gateway', since: '8.4')]
    public function pay(Request $request)
    {
        $token = session('_token');
        $data = session('purchase');

        if (! $token) {
            Log::warning(
                'Someone tried to but without a token from the server. Attackers IP : '.
                $request->ip());

            return redirect()
                ->route('dashboard.buy')
                ->withErrors('error', 'مشکلی پیش آمده است');
        }

        if (! $data) {
            return redirect()
                ->route('dashboard.buy')
                ->withErrors('error', 'اطلاعات سفارش یافت نشد.');
        }

        $user = auth()->user();

        try {

            DB::beginTransaction();

            $order = $this->orderService->createPurchaseOrder(
                $user,
                [
                    'asset_id' => $data['asset_id'], // Asset ID in DB
                    'amount' => $data['asset_amount'], // How many Users Want
                    'price' => $data['price'], // How much it Costs the user
                    'total_money' => $data['payable_amount'],
                    'status' => 'REQUESTED',
                ]
            );

            $result = $this->zarinpalService->requestPayment(
                amount: (int) $data['payable_amount'],
                description: "Purchase Order #{$order->id}",
                metadata: [
                    'mobile' => $user->mobile,
                    'email' => $user->email,
                ]
            );

            ZarinpalResponse::create([
                'user_id' => $user->id,
                'authority' => $result['data']['authority'],
                'amount' => $data['payable_amount'],
                'fee' => $result['data']['fee'] ?? null,
                'fee_type' => $result['data']['fee_type'] ?? null,
                'code' => $result['data']['code'] ?? null,
                'message' => $result['data']['message'] ?? null,
            ]);

            $code = data_get($result, 'data.code');

            if ($code !== 100) {

                DB::rollBack();

                Log::warning('Zarinpal Request Failed', [
                    'response' => $result,
                    'user_id' => $user->id,
                ]);

                return redirect()
                    ->route('dashboard.buy')
                    ->withErrors('error',
                        data_get($result, 'errors', 'خطا در ایجاد تراکنش')
                    );
            }

            DB::commit();

            session([
                'payment_order_id' => $order->id,
                'payment_authority' => data_get($result, 'data.authority'),
            ]);

            $order->update(['status', 'PENDING']);

            return redirect()->away(
                'https://sandbox.zarinpal.com/pg/StartPay/'.
                data_get($result, 'data.authority')
            );

        } catch (Throwable $e) {

            DB::rollBack();
            $errorCode = now()->format('YmdHis').rand(1000, 9999);
            Log::error("Payment Request Error $errorCode: ", [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->route('dashboard.buy')
                ->with('error', 'خطا در برقراری ارتباط با درگاه پرداخت.');
        }
    }

    /**
     * @return RedirectResponse
     * @param Request $request
     */
    #[Deprecated(reason: 'This app uses a Request - Admin approve system. Not a payment gateway', since: '8.4')]
    public function callback(Request $request)
    {
        try {
            $user = auth()->user();
            $status = data_get($request->all(), 'Status');
            $authority = data_get($request->all(), 'Authority');
            if ($status !== 'OK' || ! ZarinpalResponse::where('authority', $authority)->exists()) {
                return redirect()->route('dashboard.buy')
                    ->withErrors('error');
            }
            $zarinpal = ZarinpalResponse::where('user_id', $user->id)->where('authority', $authority)->first();
            // TO-DO
            OrderJob::dispatch($authority, $user)->onQueue('queue')->delay(now()->addSeconds(3));

            $order = $this->updateOrder($authority, $user->id, $zarinpal->amount, 'PAID');
            $balanceBefore = Wallet::where('user_id', $user->id)
                ->where('asset_id', $zarinpal->asset_id)
                ->only('balance')
                ->first();
            $wallet = Wallet::updateOrCreate([
                'user_id' => $user->id,
                'asset_id' => $order->asset_id,
                'balance' => $order->amount,
            ]);

            $walletTransaction = WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'type' => 'CREDIT',
                'amount' => $order->amount,
                'balance_before' => $balanceBefore,
                'description' => "Purchase Order #{$order->id}
                         From Goldina Using Zarinpal Gateway With Authority {$authority}
                         With Balance Before {$balanceBefore}
                         Now Added {$order->amount} to His Goldina Account
                         By User {$user->full_name} Email: {$user->email}",
            ]);
            session()->put('app-notification', 'خرید شما با موفقیت انجام شد. تا لحظاتی درگیر به حساب شما اضافه میشود. در صورت نیاز با پشتیبانی گلدینا تماس حاصل فرمایید');

            return redirect()->route('dashboard');

        } catch (Exception $e) {
            $errorCode = now()->format('YmdHis').rand(1000, 9999);
            Log::error("Payment Request Error $errorCode: ", (array) $e->getMessage());

            return redirect()->route('dashboard.buy')->withErrors('error');
        }
    }

    #[Deprecated(reason: 'This app uses a Request - Admin approve system. Not a payment gateway', since: '8.4')]
    private function updateOrder(string $authority, int $user_id, int $zarinpalAmount, string $status)
    {
        return Order::where('authority', $authority)
            ->where('user_id', $user_id)
            ->where('amount', $zarinpalAmount)
            ->latest()
            ->update([
                'status' => $status,
            ]);
    }

    /**
     * @return RedirectResponse
     * @throws Throwable
     * @param Request $request
     */
    public function requestAsset(Request $request)
    {
        $token = session('_token');
        $data = session('purchase');

        if (! $token) {
            Log::warning(
                'Someone tried to but without a token from the server. Attackers IP : '.
                $request->ip());

            return redirect()
                ->route('dashboard.buy')
                ->withErrors('error', 'مشکلی پیش آمده است');
        }

        if (! $data) {
            return redirect()
                ->route('dashboard.buy')
                ->withErrors('error', 'اطلاعات سفارش یافت نشد.');
        }

        $user = auth()->user();

        try {
            DB::beginTransaction();

            $data['key'] = Str::uuid()->toString();

            $order = $this->orderService->createPurchaseOrder(
                $user,
                [
                    'key' => $data['key'],
                    'asset_id' => $data['asset_id'], // Asset ID in DB
                    'amount' => $data['asset_amount'], // How many Users Want
                    'price' => $data['price'], // How much it Costs the user
                    'total_money' => $data['payable_amount'],
                    'status' => 'REQUESTED',
                ]
            );

            DB::commit();

            NewOrderJob::dispatch($user, $order)->onQueue('default')->delay(now()->addSeconds(2));

            session()->forget('purchase');
            return redirect()
                ->route('dashboard')
                ->with([
                    'notification' => [
                        'type' => 'success',
                        'message' => 'درخواست خرید شما با موفقیت ثبت شد',
                    ],
                ]);
        } catch (Exception $e) {
            DB::rollBack();
            $errorCode = now()->format('YmdHis').rand(1000, 9999);
            Log::error("Payment Request Error $errorCode: ", [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->route('dashboard.buy')
                ->with([
                    'notification' => [
                        'type' => 'error',
                        'message' => 'مشکلی در ثبت درخواست شما پیش آمده. '.$errorCode,
                    ],
                ]);
        }
    }
}
