<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <div>
        <form wire:submit="confirmPassword" class="space-y-6">
            <div class="space-y-2 text-right">
                <label for="password" class="text-sm font-medium text-gray-600 dark:text-gray-400 block">{{ __('رمز عبور خود را وارد کنید') }}</label>
                <input
                    wire:model.live="password"
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all text-right"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3 px-4 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-yellow-500/20 active:scale-[0.98]">
                    {{ __('تایید رمز عبور') }}
                </button>
            </div>
        </form>
    </div>
</div>
