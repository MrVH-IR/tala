<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accounter\Order;
use App\Models\Accounter\Wallet;
use App\Models\Accounter\WalletTransaction;
use App\Order\OrderEnum;
use App\Order\OrderStatusEnum as Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class SellAssetController extends Controller
{
    public function index()
    {
        $assets = Order::with(['asset', 'user'])
            ->where(function ($q) {
                $q->where('type', 'SELL')
                    ->whereIn('status', [Status::REQUESTED, Status::PAID, Status::PENDING]);
            })
            ->paginate();

        return view('admin.assets.sell_assets.index', compact('assets'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $assets = Order::with(['user', 'asset'])
            ->where('type', 'SELL')
            ->whereHas('user', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                    ->orWhere('email', 'like', "%$query%")
                    ->orWhere('mobile', 'like', "%$query%")
                    ->orWhere('last_name', 'like', "%$query%")
                    ->orWhere('national_code', 'like', "%$query%");
            })
            ->orWhereHas('asset', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                    ->orWhere('symbol', 'like', "%$query%");
            })
            ->get();

        return response()->json($assets);
    }

    /**
     * @throws Throwable
     */
    public function sellAsset(Request $request, Order $order): JsonResponse
    {
        try {

            $status = Status::from($request->status);

            DB::transaction(function () use ($order, $status) {

                /** @var Order $order */
                $order = Order::with('user')
                    ->whereKey($order->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $order->update([
                    'status' => $status,
                ]);

                if ($status !== Status::COMPLETED) {
                    return;
                }

                $wallet = Wallet::where('user_id', $order->user_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $balanceBefore = $wallet->balance;
                $balanceAfter = max(0, $balanceBefore - $order->amount);

                $wallet->update([
                    'balance' => $balanceAfter,
                    'locked_balance' => $wallet->locked_balance + $order->amount,
                ]);

                WalletTransaction::create([
                    'order_id' => $order->id,
                    'wallet_id' => $wallet->id,
                    'type' => OrderEnum::DEBIT,
                    'amount' => $order->amount,
                    'balance_before' => $balanceBefore,
                    'balance_after' => $balanceAfter,
                    'description' => "Sell #Order {$order->id} For {$order->user->email}",
                ]);

                $order->update([
                    'confirmed_by' => Auth::guard('admin')->id(),
                    'confirmed_at' => now(),
                ]);

                $wallet->update([
                    'locked_balance' => $wallet->locked_balance - $order->amount,
                ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'وضعیت با موفقیت تغییر یافت.',
            ], Response::HTTP_OK);

        } catch (Throwable $e) {

            $errorCode = now()->format('YmdHis').rand(1000, 9999);

            Log::error(
                "Exception During Sell Asset [{$errorCode}]",
                [
                    'order_id' => $order->id,
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                ]
            );

            return response()->json([
                'status' => false,
                'message' => "مشکلی پیش آمده است. کد خطا: {$errorCode}",
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
