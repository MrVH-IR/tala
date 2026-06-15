<?php

namespace Database\Factories\Accounter;

use App\Models\Accounter\Order;
use App\Models\Accounter\Asset;
use App\Models\User;
use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        $price = $this->faker->randomFloat(3, 1000, 100000);
        $amount = $this->faker->randomFloat(3, 0.1, 100);

        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'asset_id' => Asset::inRandomOrder()->first()?->id ?? Asset::factory(),
            'type' => $this->faker->randomElement(['BUY', 'SELL']),
            'amount' => $amount,
            'price' => $price,
            'total_money' => $amount * $price,
            'status' => $this->faker->randomElement(['REQUESTED', 'ADMIN_ACCEPTED', 'USER_PAID', 'ADMIN_CONFIRMED', 'COMPLETED', 'REJECTED']),
            'confirmed_by' => Admin::inRandomOrder()->first()?->id,
            'confirmed_at' => now(),
        ];
    }
}
