<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-right text-gray-800 dark:text-gray-200">
            {{ __('پنل') }}
        </h2>
    </x-slot>

    <div id="login-alert" class="py-12 transition-opacity duration-700">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 font-bold text-right text-gray-900 dark:text-gray-100">
                    {{ '😊 خوش آمدید' }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="relative p-6 overflow-hidden shadow-xl rounded-xl bg-gradient-to-br from-yellow-300 via-yellow-200 to-yellow-400 dark:from-yellow-600 dark:via-yellow-500 dark:to-yellow-700">
                <div class="absolute inset-0 opacity-20 bg-gradient-to-tr from-white via-transparent to-white"></div>
                <div class="relative z-10 text-right text-gray-900 dark:text-gray-900">
                    <div class="mb-4 text-xl font-extrabold text-center">
                        🪙 کارت طلایی شما
                    </div>
                    <div class="grid grid-cols-1 gap-4 text-sm font-semibold sm:grid-cols-2">
                        <div>
                            <span class="block text-gray-700">نام کاربر</span>
                            <span class="text-lg">{{ auth()->user()->name }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-700">ایمیل</span>
                            <span class="text-lg">{{ auth()->user()->email }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-700">موجودی طلا</span>
                            <span class="text-lg">12.35 گرم</span>
                        </div>
                        <div>
                            <span class="block text-gray-700">ارزش دارایی</span>
                            <span class="text-lg">985,000 تومان</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(() => {
                    const alertBox = document.getElementById('login-alert');
                    if (alertBox) {
                        alertBox.classList.add('opacity-0');
                        setTimeout(() => alertBox.remove(), 700);
                    }
                }, 2500);
            });
        </script>
    @endpush
</x-app-layout>
