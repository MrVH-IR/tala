<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $last_name = '';
    public string $email = '';
    public string $mobile = '';
    public string $national_code = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'mobile' => ['required', 'string', 'regex:/^09\d{9}$/', 'unique:'.User::class],
            'national_code' => ['required', 'string', 'size:10', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register" class="space-y-5">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="space-y-2 text-right">
                <label for="name" class="text-sm font-medium text-gray-600 dark:text-gray-400 block">{{ __('نام') }}</label>
                <input 
                    wire:model.live="name" 
                    id="name" 
                    type="text" 
                    name="name" 
                    required 
                    autofocus 
                    autocomplete="given-name" 
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all text-right"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <div class="space-y-2 text-right">
                <label for="last_name" class="text-sm font-medium text-gray-600 dark:text-gray-400 block">{{ __('نام خانوادگی') }}</label>
                <input 
                    wire:model.live="last_name" 
                    id="last_name" 
                    type="text" 
                    name="last_name" 
                    required 
                    autocomplete="family-name" 
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all text-right"
                />
                <x-input-error :messages="$errors->get('last_name')" class="mt-1" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="space-y-2 text-right">
                <label for="email" class="text-sm font-medium text-gray-600 dark:text-gray-400 block">{{ __('ایمیل') }}</label>
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

            <div class="space-y-2 text-right">
                <label for="mobile" class="text-sm font-medium text-gray-600 dark:text-gray-400 block">{{ __('شماره موبایل') }}</label>
                <input 
                    wire:model.live="mobile" 
                    id="mobile" 
                    type="text" 
                    name="mobile" 
                    required 
                    placeholder="09123456789"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all text-right"
                />
                <x-input-error :messages="$errors->get('mobile')" class="mt-1" />
            </div>
        </div>

        <div class="space-y-2 text-right">
            <label for="national_code" class="text-sm font-medium text-gray-600 dark:text-gray-400 block">{{ __('کد ملی') }}</label>
            <input 
                wire:model.live="national_code" 
                id="national_code" 
                type="text" 
                name="national_code" 
                required 
                placeholder="1234567890"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all text-right"
            />
            <x-input-error :messages="$errors->get('national_code')" class="mt-1" />
        </div>

        <div class="space-y-2 text-right">
            <label for="password" class="text-sm font-medium text-gray-600 dark:text-gray-400 block">{{ __('رمز عبور') }}</label>
            <input 
                wire:model.live="password" 
                id="password" 
                type="password" 
                name="password" 
                required 
                autocomplete="new-password" 
                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all text-right"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="space-y-2 text-right">
            <label for="password_confirmation" class="text-sm font-medium text-gray-600 dark:text-gray-400 block">{{ __('تایید رمز عبور') }}</label>
            <input 
                wire:model.live="password_confirmation" 
                id="password_confirmation" 
                type="password" 
                name="password_confirmation" 
                required 
                autocomplete="new-password" 
                class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all text-right"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="flex items-center justify-between pt-2">
            <a class="text-sm text-gray-500 hover:text-yellow-600 dark:text-gray-400 dark:hover:text-yellow-400 underline transition-colors" href="{{ route('login') }}" wire:navigate>
                {{ __('قبلا ثبت نام کرده اید؟') }}
            </a>

            <button type="submit" class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-yellow-500/20 active:scale-[0.98]">
                {{ __('ثبت نام') }}
            </button>
        </div>
    </form>
</div>
