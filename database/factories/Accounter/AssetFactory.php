<?php

namespace Database\Factories\Accounter;

use App\Models\Accounter\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['gold', 'currency', 'crypto'];
        $category = $this->faker->randomElement($categories);

        $symbols = [
            'gold' => ['IR_GOLD_18K', 'IR_GOLD_24K', 'GOLD_OZ'],
            'currency' => ['USD_IRR', 'EUR_IRR', 'AED_IRR'],
            'crypto' => ['BTC_USDT', 'ETH_USDT', 'SOL_USDT'],
        ];

        $symbol = $this->faker->randomElement($symbols[$category]);

        return [
            'category' => $category,
            'symbol' => $symbol,
            'name' => $this->faker->words(2, true),
            'unit' => $category === 'gold' ? 'gram' : 'unit',
            'precision' => $category === 'crypto' ? 6 : 2,
            'is_active' => true,
        ];
    }
}
