<?php

use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use Livewire\Volt\Volt;
use App\Models\User;

test('profile component can be rendered', function () {
    $user = User::factory()->create();
    
    $this->actingAs($user);

    Livewire\Livewire::test(Profile::class)
        ->assertSee('تنظیمات پروفایل');
});

test('password component can be rendered', function () {
    $user = User::factory()->create();
    
    $this->actingAs($user);

    Livewire\Livewire::test(Password::class)
        ->assertSee('تغییر رمز عبور');
});
