<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\{
    HomeComponent,
    DashboardComponent,
    Settings\Profile,
    Settings\Password,
    Buy\BuyComponent
};

Route::get('/', HomeComponent::class)->name('home');

Route::get('/dashboard', DashboardComponent::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('dashboard')->group(function () {
    Route::get('/buy' , BuyComponent::class)->name('dashboard.buy');
    Route::get('/sell')->name('dashboard.sell');
    Route::get('/setting', function () {
        return view('livewire.settings.index');
    })->name('dashboard.setting');

    Route::get('/setting/profile', Profile::class)->name('dashboard.setting.profile');
    Route::get('/setting/password', Password::class)->name('dashboard.setting.password');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
