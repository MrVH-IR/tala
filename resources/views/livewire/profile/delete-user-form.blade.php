<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="space-y-6">

    <header>

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            حذف حساب کاربری
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            با حذف حساب کاربری، تمامی اطلاعات، داده‌ها و سوابق مرتبط به‌صورت دائمی حذف خواهند شد و امکان بازیابی آن‌ها وجود نخواهد داشت. در صورت نیاز، پیش از حذف حساب، از اطلاعات موردنظر خود نسخه پشتیبان تهیه کنید.
        </p>

    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        حذف حساب کاربری
    </x-danger-button>

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->isNotEmpty()"
        focusable
    >

        <form wire:submit="deleteUser" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                آیا از حذف حساب کاربری خود اطمینان دارید؟
            </h2>

            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                این عملیات غیرقابل بازگشت است و تمامی اطلاعات، سوابق و داده‌های مرتبط با حساب شما برای همیشه حذف خواهند شد.
                برای تأیید حذف، لطفاً رمز عبور خود را وارد کنید.
            </p>

            <div class="mt-6">

                <x-input-label
                    for="password"
                    value="رمز عبور"
                    class="sr-only"
                />

                <x-text-input
                    wire:model.live="password"
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="رمز عبور"
                />

                <x-input-error
                    :messages="$errors->get('password')"
                    class="mt-2"
                />

            </div>

            <div class="mt-6 flex justify-end">

                <x-secondary-button
                    x-on:click="$dispatch('close')"
                >
                    انصراف
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    حذف حساب کاربری
                </x-danger-button>

            </div>

        </form>

    </x-modal>

</section>
