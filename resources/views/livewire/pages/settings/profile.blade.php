<?php

use App\Models\User;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

new #[Layout('layouts.app')] class extends Component
{
    #[Validate('nullable|string|min:3|max:150')]
    public string $name = '';

    #[Validate('nullable|string|min:3|max:150')]
    public string $last_name = '';

    #[Validate('nullable|string|regex:/^09\d{9}$/')]
    public ?string $mobile = null;

    #[Validate('nullable|string|min:10|max:10')]
    public ?string $national_code = null;

    #[Validate('nullable|string|min:16|max:16')]
    public ?string $card_number = null;

    #[Validate('nullable|string|min:26|max:26')]
    public ?string $sheba = null;

    public bool $is_default = false;
    public bool $showAdminModal = false;
    public string $admins_message = '';
    public bool $is_verified = false;

    public function mount(): void
    {
        $user = auth()->user();

        $this->name = $user->name ?? '';
        $this->last_name = $user->last_name ?? '';
        $this->mobile = $user->mobile ?? null;
        $this->national_code = $user->national_code ?? null;

        $card = $user->userCreditCardInformation;

        if ($card) {
            $this->card_number = $card->card_number ?? null;
            $this->sheba = $card->sheba ?? null;
            $this->is_default = $card->is_default ?? false;
            $this->admins_message = $card->admins_message ?? '';
            $this->is_verified = (bool)($card->verified_at ?? false);

            if (!empty($this->admins_message) && is_null($card->message_read_at)) {
                $this->showAdminModal = true;
            }
        }
    }

    public function markAsRead(): void
    {
        $card = auth()->user()->userCreditCardInformation;
        if ($card) {
            $card->update(['message_read_at' => now()]);
        }
        $this->showAdminModal = false;
    }

    public function save(): void
    {
        $this->validate();

        $user = auth()->user();
        $updated = false;

        $user->fill([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'national_code' => $this->national_code,
        ]);

        if ($user->isDirty()) {
            $user->save();
            $updated = true;
        }

        $card = $user->userCreditCardInformation()->first();

        if ($card) {
            $card->fill([
                'card_number' => $this->card_number,
                'sheba' => $this->sheba,
                'is_default' => $this->is_default,
            ]);

            if ($card->isDirty()) {
                $card->save();
                $updated = true;
            }
        } else {
            if ($this->card_number || $this->sheba) {
                $user->userCreditCardInformation()->create([
                    'card_number' => $this->card_number,
                    'sheba' => $this->sheba,
                    'is_default' => $this->is_default,
                ]);
                $updated = true;
            }
        }

        if ($updated) {
            $user->notify(new \App\Notifications\AccountSecurityUpdated('profile'));
            $this->dispatch('app-notification', '✅ اطلاعات با موفقیت ذخیره شد');
        } else {
            $this->dispatch('app-notification', '⚠️ هیچ تغییری اعمال نشد چون داده‌ها یکسان بودند');
        }
    }
}; ?>

<div class="flex items-center justify-center min-h-screen px-4 py-10 bg-gray-100 dark:bg-gray-900">
    <!-- Admin Message Modal -->
    @if($showAdminModal)
        <div class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
            <div class="w-full max-w-md p-6 bg-white dark:bg-gray-800 shadow-2xl rounded-3xl border border-gray-100 dark:border-gray-700 transform transition-all">
                <div class="flex items-center gap-3 mb-4 text-yellow-600 dark:text-yellow-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-lg font-bold">پیام مدیریت</h3>
                </div>
                <p class="mb-6 text-right text-gray-600 dark:text-gray-300 leading-relaxed">
                    {{ $admins_message }}
                </p>
                <button wire:click="markAsRead"
                        class="w-full py-3 text-sm font-bold text-white transition-all duration-200 rounded-xl bg-gradient-to-r from-yellow-500 to-orange-500 hover:scale-[1.02] active:scale-95">
                    متوجه شدم
                </button>
            </div>
        </div>
    @endif

    <div class="w-full max-w-md p-8 bg-white shadow-xl dark:bg-gray-800 rounded-2xl">
        <div class="flex items-center justify-center gap-2 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">تنظیمات پروفایل</h2>
            @if($is_verified)
                <span class="flex items-center justify-center w-6 h-6 bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-full" title="حساب تایید شده">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.707-7.707a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            @endif
        </div>

        <form wire:submit="save" class="space-y-8">
            <!-- Personal Information Section -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 text-right mb-4">
                    <span class="text-sm font-bold text-gray-400 uppercase tracking-wider">اطلاعات شخصی</span>
                    <div class="h-px flex-1 bg-gray-200 dark:bg-gray-700"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2 text-right">
                        <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">نام</label>
                        <input type="text" wire:model="name" placeholder="نام خود را وارد کنید"
                               class="w-full px-4 py-2 text-gray-800 placeholder-gray-400 transition-all duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-700 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-pink-500 focus:outline-none text-right" />
                        @error('name')
                        <p class="mt-1 text-sm text-red-500 text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2 text-right">
                        <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">نام خانوادگی</label>
                        <input type="text" wire:model="last_name" placeholder="نام خانوادگی خود را وارد کنید"
                               class="w-full px-4 py-2 text-gray-800 placeholder-gray-400 transition-all duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-700 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-pink-500 focus:outline-none text-right" />
                        @error('last_name')
                        <p class="mt-1 text-sm text-red-500 text-right">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-2 text-right">
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">شماره موبایل</label>
                    <input type="text" wire:model="mobile" placeholder="09xxxxxxxxx" inputmode="numeric"
                           class="w-full px-4 py-2 text-gray-800 placeholder-gray-400 transition-all duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-700 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-pink-500 focus:outline-none text-right" />
                    @error('mobile')
                    <p class="mt-1 text-sm text-red-500 text-right">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2 text-right">
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">کد ملی</label>
                    <input type="text" wire:model="national_code"
                           class="w-full px-4 py-2 text-gray-800 placeholder-gray-400 transition-all duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-700 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-pink-500 focus:outline-none text-right" />
                    @error('national_code') <p class="mt-1 text-sm text-red-500 text-right">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Payment Information Section -->
            <div class="space-y-4">
                <div class="flex items-center gap-2 text-right mb-4">
                    <span class="text-sm font-bold text-gray-400 uppercase tracking-wider">اطلاعات پرداخت</span>
                    <div class="h-px flex-1 bg-gray-200 dark:bg-gray-700"></div>
                </div>

                <div class="space-y-2 text-right">
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">شماره کارت</label>
                    <input type="text" wire:model="card_number"
                           class="w-full px-4 py-2 text-gray-800 placeholder-gray-400 transition-all duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-700 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-pink-500 focus:outline-none text-right" />
                    @error('card_number') <p class="mt-1 text-sm text-red-500 text-right">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2 text-right">
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">شماره شبا</label>
                    <input type="text" wire:model="sheba"
                           class="w-full px-4 py-2 text-gray-800 placeholder-gray-400 transition-all duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-700 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-pink-500 focus:outline-none text-right" />
                    @error('sheba') <p class="mt-1 text-sm text-red-500 text-right">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end gap-3 py-2">
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('کارت پیش‌فرض') }}</span>
                    <input type="checkbox" wire:model="is_default" class="w-5 h-5 rounded text-pink-500 focus:ring-pink-500 dark:bg-gray-700 dark:border-gray-600" />
                </div>
            </div>

            <button type="submit"
                    class="w-full py-3 text-lg font-semibold text-white transition-all duration-200 shadow-lg rounded-xl bg-gradient-to-r from-pink-500 to-rose-500 hover:scale-105 hover:shadow-pink-500/50">
                ذخیره تغییرات
            </button>
        </form>
    </div>
</div>
