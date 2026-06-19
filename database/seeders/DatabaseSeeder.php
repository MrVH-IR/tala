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
        Admin::factory(5)->create();
        User::factory(5)->create();
    }
}
