<?php

use App\Models\User;
use Livewire\Volt\Volt;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response
        ->assertOk();
});

test('new users can register', function () {
    $component = Volt::test('pages.auth.register')
        ->set('name', 'Test User')
        ->set('last_name', 'Test LastName')
        ->set('email', 'test@example.com')
        ->set('mobile', '09123456789')
        ->set('national_code', '1234567890')
        ->set('password', 'password')
        ->set('password_confirmation', 'password');

    $component->call('register');

    $component->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});

test('unverified users cannot access dashboard', function () {
    $user = User::factory()->unverified()->create();
    
    expect($user->email_verified_at)->toBeNull();

    $response = $this->actingAs($user)->get('/dashboard');

    $response->assertRedirect('/verify-email');
});
