<?php

namespace Database\Seeders;

use App\Models\Accounter\Asset;
use App\Models\Accounter\Order;
use App\Models\Accounter\Wallet;
use App\Models\Accounter\WalletTransaction;
use App\Models\Admin\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        // 🧑‍💻 1. Create User
        $user = User::factory()->create();

        // 💳 2. Credit Card Info
        $user->userCreditCardInformation()->create([
            'card_number' => '5022291543512013',
            'sheba' => '210600363670017155452421',
            'is_default' => true,
            'admins_message' => 'سیستم تست مالی فعال شد',
            'verified_at' => now(),
        ]);

        // 🪙 3. Assets
        $assets = Asset::all();

        // 💰 4. Create Wallets
        $wallets = $assets->map(function ($asset) use ($user) {
            return Wallet::create([
                'user_id' => $user->id,
                'asset_id' => $asset->id,
                'balance' => fake()->randomFloat(4, 0.1, 10),
                'locked_balance' => 0,
            ]);
        });

        // 📦 5. Create Orders (bulk)
        $orders = collect();

        for ($i = 0; $i < 20; $i++) {

            $asset = $assets->random();

            $amount = fake()->randomFloat(4, 0.1, 5);
            $price = fake()->numberBetween(100000, 5000000);

            $key = Str::uuid()->toString();

            $orders->push(
                Order::create([
                    'key' => $key,
                    'user_id' => $user->id,
                    'asset_id' => $asset->id,
                    'type' => Arr::random(['BUY', 'SELL']),
                    'amount' => $amount,
                    'price' => $price,
                    'total_money' => $amount * $price,
                    'status' => Arr::random([
                        'PENDING',
                        'COMPLETED',
                        'CANCELLED',
                        'REJECTED',
                    ]),
                    'confirmed_by' => Admin::inRandomOrder()->value('id'),
                    'confirmed_at' => now(),
                ])
            );
        }

        // 💸 6. Create Wallet Transactions based on successful orders
        foreach ($orders->where('status', 'COMPLETED') as $order) {

            $wallet = $wallets->firstWhere('asset_id', $order->asset_id);

            if (! $wallet) {
                continue;
            }

            // BUY → increase balance
            if ($order->type === 'BUY') {

                $wallet->increment('balance', $order->amount);

                WalletTransaction::create([
                    'wallet_id' => $wallet->id,
                    'type' => 'CREDIT',
                    'amount' => $order->amount,
                    'balance_before' => $wallet->balance - $order->amount,
                    'balance_after' => $wallet->balance,
                    'description' => 'Seed BUY order',
                ]);
            }

            // SELL → decrease balance
            if ($order->type === 'SELL') {

                $wallet->decrement('balance', $order->amount);

                WalletTransaction::create([
                    'wallet_id' => $wallet->id,
                    'type' => 'DEBIT',
                    'amount' => $order->amount,
                    'balance_before' => $wallet->balance + $order->amount,
                    'balance_after' => $wallet->balance,
                    'description' => 'Seed SELL order',
                ]);
            }
        }
    }
}
