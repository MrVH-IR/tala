<?php

namespace Database\Factories\Accounter;

use App\Models\Accounter\WalletTransaction;
use App\Models\Accounter\Wallet;
use App\Models\User;
use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletTransactionFactory extends Factory
{
    public function definition(): array
    {
        $wallet = Wallet::inRandomOrder()->first();

        return [
            'wallet_id' => $wallet?->id ?? Wallet::factory(),
            'user_id' => $wallet?->user_id ?? User::factory(),
            'type' => $this->faker->randomElement(['CREDIT', 'DEBIT']),
            'amount' => $this->faker->randomFloat(6, 0.01, 1000),
            'source_type' => 'manual_adjustment',
            'source_id' => null,
            'description' => $this->faker->sentence(),
            'created_by' => Admin::inRandomOrder()->first()?->id,
        ];
    }
}
