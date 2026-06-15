<?php

namespace Database\Factories\Accounter;

use App\Models\Accounter\Wallet;
use App\Models\Accounter\Asset;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'asset_id' => Asset::inRandomOrder()->first()?->id ?? Asset::factory(),
            'balance' => $this->faker->randomFloat(6, 0, 1000),
        ];
    }
}
