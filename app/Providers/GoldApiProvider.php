<?php

namespace App\Providers;

use App\Classes\AdminGoldApi;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GoldApiProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('admin.layouts.app', function ($view) {
            $view->with([
                'gold' => AdminGoldApi::goldPrice(),
            ]);
        });
    }
}
