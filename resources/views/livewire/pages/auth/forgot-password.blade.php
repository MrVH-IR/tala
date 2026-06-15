<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('رمز خود را فراموش کرده اید؟ مشکلی ندارد. فقط ایمیل که با آن ثبت نام کرده اید را بنویسید و لینک تغییر پسورد برای شما ارسال میشود.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div>
        <form wire:submit="sendResetLink" class="space-y-6">
            <div class="space-y-2 text-right">
                <label for="email" class="text-sm font-medium text-gray-600 dark:text-gray-400 block">{{ __('ایمیل خود را وارد کنید') }}</label>
                <input
                    wire:model.live="email"
                    id="email"
                    type="email"
                    name="email"
                    required
                    autocomplete="username"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all text-right"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3 px-4 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-yellow-500/20 active:scale-[0.98]">
                    {{ __('ارسال لینک بازیابی') }}
                </button>
            </div>
        </form>
    </div>
</div>

