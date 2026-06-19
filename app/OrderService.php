<?php

namespace App;

use App\Models\Accounter\Order;
use App\Models\Accounter\Wallet;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Create a new purchase order.
     */
    public function createPurchaseOrder(User $user, array $data): Order
    {
        return DB::transaction(function () use ($user, $data) {
            return Order::create([
                'user_id' => $user->id,
                'asset_id' => $data['asset_id'],
                'type' => 'BUY',
                'amount' => $data['amount'],
                'price' => $data['price'],
                'total_money' => $data['total'],
                'status' => 'REQUESTED',
            ]);
        });
    }

    /**
     * Complete an order and update the user's wallet.
     */
    public function completeOrder(Order $order): void
    {
        DB::transaction(function () use ($order) {
            // 1. Update Order Status
            $order->update([
                'status' => 'COMPLETED',
                'confirmed_at' => now(),
            ]);

            // 2. Update or Create Wallet
            $wallet = Wallet::firstOrCreate(
                ['user_id' => $order->user_id, 'asset_id' => $order->asset_id],
                ['balance' => 0]
            );

            $wallet->increment('balance', $order->amount);
        });
    }
}
