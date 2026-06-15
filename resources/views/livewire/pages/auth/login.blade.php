<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="space-y-6">
        <div class="space-y-2 text-right">
            <label for="email" class="text-sm font-medium text-gray-600 dark:text-gray-400 block">{{ __('ایمیل') }}</label>
            <input
                wire:model.live="form.email"
                id="email"
                type="email"
                name="email"
                required
                autofocus
                autocomplete="username"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all text-right"
            />
            <x-input-error :messages="$errors->get('form.email')" class="mt-1" />
        </div>

        <div class="space-y-2 text-right">
            <label for="password" class="text-sm font-medium text-gray-600 dark:text-gray-400 block">{{ __('رمز عبور') }}</label>
            <input
                wire:model.live="form.password"
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all text-right"
            />
            <x-input-error :messages="$errors->get('form.password')" class="mt-1" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center cursor-pointer">
                <input wire:model.live="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-yellow-500 shadow-sm focus:ring-yellow-500 dark:bg-gray-900 dark:border-gray-700" name="remember">
                <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('مرا به خاطر بسپار') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-500 hover:text-yellow-600 dark:text-gray-400 dark:hover:text-yellow-400 underline transition-colors" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('رمز عبور را فراموش کردید؟') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-3 px-4 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-yellow-500/20 active:scale-[0.98]">
                {{ __('ورود به حساب') }}
            </button>
        </div>
    </form>
</div>
