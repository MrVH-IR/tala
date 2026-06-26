<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accounter\Order;
use App\Models\Accounter\Wallet;
use App\Models\Accounter\WalletTransaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestBuyAsset extends Controller
{
    public function index()
    {
        $orders = Order::whereIn('status', ['REQUESTED', 'PENDING', 'PAID'])
            ->where('type', 'BUY')
            ->paginate(10);

        return view('admin.requestBuyAsset.index', compact('orders'));
    }

    /**
     * @throws \Throwable
     */
    public function changeStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|in:PENDING,PAID,REJECTED,CANCELLED,COMPLETED',
        ]);

        $this->ensureValidTransition($order->status, $data['status']);

        DB::transaction(function () use ($order, $data) {
            $order = Order::lockForUpdate()->findOrFail($order->id);

            $this->ensureValidTransition($order->status, $data['status']);

            $order->update([
                'status' => $data['status'],
                'confirmed_by' => Auth::guard('admin')->id(),
                'confirmed_at' => now(),
            ]);
            if ($data['status'] === 'COMPLETED') {
                $wallet = Wallet::where('user_id', $order->user_id)
                    ->where('asset_id', $order->asset_id)
                    ->lockForUpdate()
                    ->first();

                $before = $wallet?->balance ?? 0;
                $after = $before + $order->amount;

                if ($wallet) {
                    $wallet->update([
                        'balance' => $after,
                    ]);
                } else {
                    $wallet = Wallet::create([
                        'user_id' => $order->user_id,
                        'asset_id' => $order->asset_id,
                        'balance' => $after,
                        'locked_balance' => 0,
                    ]);
                }

                WalletTransaction::create([
                    'order_id' => $order->id,
                    'wallet_id' => $wallet->id,
                    'type' => 'CREDIT',
                    'amount' => $order->amount,
                    'balance_before' => $before,
                    'balance_after' => $after,
                    'description' => sprintf(
                        'تکمیل سفارش خرید #%d توسط مدیر #%d',
                        $order->id,
                        Auth::guard('admin')->id()
                    ),
                ]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'وضعیت با موفقیت تغییر یافت.',
        ]);
    }

    /**
     * @throws Exception
     */
    private function ensureValidTransition(string $current, string $next): void
    {
        $allowedTransitions = [
            'REQUESTED' => ['PAID', 'REJECTED', 'CANCELLED'],
            'PAID' => ['COMPLETED'],
        ];
        $allowed = $allowedTransitions[$current] ?? [];

        if (! in_array($next, $allowed, true)) {
            throw new Exception("Invalid status transition: {$current} -> {$next}");
        }
    }
}
