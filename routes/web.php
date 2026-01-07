<?php

use App\Classes\GoldApi;
use Illuminate\Support\Facades\Route;
use App\Livewire\HomeComponent;

Route::get('/', HomeComponent::class)->name('home');

Route::get('/gold-test' , [GoldApi::class , '__invoke']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('dashboard')->group(function () {
    Route::get('/buy')->name('dashboard.buy');
    Route::get('/sell')->name('dashboard.sell');
    Route::get('/setting', function () {
        return view('livewire.settings.index');
    })->name('dashboard.setting');

    Route::get('/setting/profile', \App\Livewire\Settings\Profile::class)->name('dashboard.setting.profile');
    Route::get('/setting/password', \App\Livewire\Settings\Password::class)->name('dashboard.setting.password');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
