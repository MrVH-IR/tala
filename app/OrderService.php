<?php

namespace App;

use App\Models\Accounter\Order;
use App\Models\Accounter\Wallet;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class OrderService
{
    /**
     * Create a new purchase order.
     *
     * @throws Throwable
     */
    public function createPurchaseOrder(User $user, array $data = []): Order
    {
        try {
            return DB::transaction(function () use ($user, $data) {
                return Order::create([
                    'user_id' => $user->id,
                    'asset_id' => $data['asset_id'],
                    'type' => 'BUY',
                    'amount' => $data['amount'],
                    'price' => $data['price'],
                    'total_money' => $data['total_money'],
                    'status' => $data['status'],
                ]);
            });
        } catch (Throwable $th) {
            DB::rollBack();
            $errorCode = now()->format('YmdHis').rand(1000, 9999);
            Log::error("Error in Creating Purchase Order {$errorCode}: ".$th->getMessage());
            throw new $th;
        }
    }

    /**
     * Complete an order and update the user's wallet.
     *
     * @throws Throwable
     */
    public function completeOrder(Order $order): void
    {
        try {
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
        } catch (Throwable $th) {
            DB::rollBack();
            $errorCode = now()->format('YmdHis').rand(1000, 9999);
            Log::error("Error in Complete Purchase Order $errorCode: ".$th->getMessage());
            throw new $th;
        }
    }

    public function createSellRequest(Order $order)
    {
        try {
            DB::transaction(function () use ($order) {
                return DB::table('wallets')->where('id', $order->id)->update([]);
            });
        } catch (Throwable $th) {
            DB::rollBack();
        }
    }
}
