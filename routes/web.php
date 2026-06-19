<?php

use App\Http\Controllers\Payment\PaymentController;
use App\Http\Middleware\Buy\EnsureUserHasPaymentProfile;
use App\Livewire\AboutPage;
use App\Livewire\BlogPage;
use App\Livewire\Buy\BuyComponent;
use App\Livewire\ContactForm;
use App\Livewire\DashboardComponent;
use App\Livewire\HomeComponent;
use App\Livewire\InfoPage;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', HomeComponent::class)->name('home');

Route::get('/about', AboutPage::class)->name('about');
Route::get('/resources', InfoPage::class)->name('resources');
Route::get('/rules', InfoPage::class)->name('rules');
Route::get('/privacy', InfoPage::class)->name('privacy');
Route::get('/blog', BlogPage::class)->name('blog');
Route::get('/contact', ContactForm::class)->name('contact');

Route::prefix('dashboard')->middleware(['auth', EnsureEmailIsVerified::class])->group(function () {
    Route::get('/', DashboardComponent::class)->name('dashboard');
    Route::get('/buy', BuyComponent::class)->middleware('auth', 'verified', EnsureUserHasPaymentProfile::class)->name('dashboard.buy');
    Route::get('/sell')->name('dashboard.sell');
    Route::get('/setting', function () {
        return view('livewire.settings.index');
    })->name('dashboard.setting');

    Volt::route('/setting/profile', 'pages.settings.profile')
        ->middleware('throttle:10,1')
        ->name('dashboard.setting.profile');

    Volt::route('/setting/password', 'pages.settings.password')
        ->middleware('throttle:10,1')
        ->name('dashboard.setting.password');

    Route::post('/payment/order/{user}', [PaymentController::class, 'pay'])->name('payment.order');
    Route::get('/payment/callback/{user}', [PaymentController::class, 'callback'])->name('dashboard.payment.callback');
});

Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

Route::fallback(function () {
    return redirect()->route('home');
});

require __DIR__.'/auth.php';
