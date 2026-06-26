<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Admin::factory(1)->create();
        User::factory(5)->create();

        $this->call([
            AssetSeeder::class,
            PostSeeder::class,
            TransactionSeeder::class,
        ]);
    }
}
