<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Jobs\Order\SellJob;
use App\Models\Accounter\Asset;
use App\Models\Accounter\Wallet;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellController extends Controller
{
    public function requestSell(Request $request): RedirectResponse
    {
        try {
            $sale = session()->get('sale');
            if (empty($sale)) {
                return redirect()->route('dashboard.payment.sell')
                    ->with(['notification' => [
                        'message' => 'شما درخواستی برای فروش ثبت نکرده اید.',
                        'type' => 'error']]);
            }
            $checks = [
                'symbol' => [
                    'status' => Asset::where('symbol', $sale['symbol'])
                        ->first()
                        ->exists(),
                    'message' => 'دارایی مورد نظر پیدا نشد.',
                ],
                'amount' => [
                    'status' => Wallet::where('user_id', $sale['user'])
                        ->where('balance', '>=', $sale['amount'])
                        ->where('locked_balance', '=<', $sale['amount'])
                        ->first()
                        ->exists(),
                    'message' => 'موجودی کیف پول برای فروش کافی نیست.',
                ],
            ];
            foreach ($checks as $check) {
                if (! $check['status']) {
                    return redirect()
                        ->route('dashboard.payment.sell')
                        ->with(['notification' => [
                            'message' => $check['message'],
                            'type' => 'error']]);
                }
            }
            $sale['idempotency_key'] = Str::uuid()->toString();
            SellJob::dispatch($sale)->onQueue('default')->delay(now()->addSeconds(5));

            return redirect()
                ->route('dashboard')
                ->with('notification', [
                    'type' => 'success',
                    'message' => 'درخواست شما با موفقیت ثبت شد',
                ]);
        } catch (HttpException $e) {
            $errorID = now()->format('YmdHis').rand(1000, 9999);
            Log::error("HTTP Exception: $errorID ".$e->getMessage().PHP_EOL);

            return redirect()->route('dashboard.sell')
                ->with(['notification' => [
                    'message' => 'مشکلی در ثبت فروش پیش آمده است '.$errorID,
                    'type' => 'error',
                ]]);
        } catch (Exception $e) {
            $errorID = now()->format('YmdHis').rand(1000, 9999);
            Log::error("Exception: $errorID ".$e->getMessage().PHP_EOL);

            return redirect()->route('dashboard.sell')
                ->with(['notification' => [
                    'message' => 'مشکلی در ثبت فروش پیش آمده است '.$errorID,
                    'type' => 'error',
                ]]);
        } finally {
            session()->forget('sale');
        }
    }
}
