<?php

namespace Database\Factories\Accounter;

use App\Models\Accounter\MarketPrice;
use App\Models\Accounter\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketPriceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'asset_id' => Asset::inRandomOrder()->first()?->id ?? Asset::factory(),
            'price' => $this->faker->randomFloat(3, 1000, 100000000),
            'priced_at' => now(),
        ];
    }
}
