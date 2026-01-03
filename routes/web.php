<?php

use App\Classes\GoldApi;
use Illuminate\Support\Facades\Route;
use App\Livewire\HomeComponent;

Route::get('/', HomeComponent::class)->name('home');

Route::get('/gold-test' , [GoldApi::class , '__invoke']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
