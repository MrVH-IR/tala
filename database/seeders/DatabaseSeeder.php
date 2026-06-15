<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use App\Models\User;
use App\Models\Accounter\Asset;
use App\Models\Accounter\MarketPrice;
use App\Models\Accounter\Order;
use App\Models\Accounter\Wallet;
use App\Models\Accounter\WalletTransaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admins and Users first
        Admin::factory(5)->create();
        User::factory(20)->create();

        // Create Core Assets
        $assets = [
            ['category' => 'gold', 'symbol' => 'IR_GOLD_18K', 'name' => 'طلای ۱۸ عیار', 'unit' => 'gram'],
            ['category' => 'gold', 'symbol' => 'IR_GOLD_24K', 'name' => 'طلای ۲۴ عیار', 'unit' => 'gram'],
            ['category' => 'gold', 'symbol' => 'GOLD_OZ', 'name' => 'اونس جهانی', 'unit' => 'ounce'],
            ['category' => 'currency', 'symbol' => 'USD_IRR', 'name' => 'دلار آمریکا', 'unit' => 'unit'],
            ['category' => 'currency', 'symbol' => 'EUR_IRR', 'name' => 'یورو', 'unit' => 'unit'],
            ['category' => 'crypto', 'symbol' => 'BTC_USDT', 'name' => 'بیت‌کوین', 'unit' => 'BTC'],
            ['category' => 'crypto', 'symbol' => 'ETH_USDT', 'name' => 'اتریوم', 'unit' => 'ETH'],
        ];

        foreach ($assets as $assetData) {
            $asset = Asset::create($assetData);
            // Create some price history for each asset
            MarketPrice::factory(10)->create(['asset_id' => $asset->id]);
        }

        // Create Wallets and Orders for some users
        User::all()->each(function ($user) {
            Asset::all()->each(function ($asset) use ($user) {
                Wallet::factory()->create([
                    'user_id' => $user->id,
                    'asset_id' => $asset->id,
                ]);
            });
        });

        Order::factory(50)->create();
        WalletTransaction::factory(100)->create();
    }
}
