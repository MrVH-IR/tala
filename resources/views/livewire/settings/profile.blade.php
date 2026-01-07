<x-app-layout>
    <div class="flex items-center justify-center min-h-screen px-4 py-10 bg-gray-100 dark:bg-gray-900">
        <!-- کارت فرم -->
        <div class="w-full max-w-md p-8 bg-white shadow-xl dark:bg-gray-800 rounded-2xl">
            <h2 class="mb-6 text-2xl font-bold text-center text-gray-800 dark:text-white">تنظیمات پروفایل</h2>

            <form wire:submit.prevent="save" class="space-y-5">

                <!-- نام -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">نام</label>
                    <input type="text" wire:model.defer="name" placeholder="نام خود را وارد کنید"
                        class="w-full px-4 py-2 text-gray-800 placeholder-gray-400 transition-all duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-700 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-pink-500 focus:outline-none" />
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- موبایل -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">شماره موبایل</label>
                    <input type="text" wire:model.defer="mobile" placeholder="09xxxxxxxxx" inputmode="numeric"
                        class="w-full px-4 py-2 text-gray-800 placeholder-gray-400 transition-all duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-700 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-pink-500 focus:outline-none" />
                    @error('mobile')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- دکمه ذخیره -->
                <button type="submit"
                    class="w-full py-3 text-lg font-semibold text-white transition-all duration-200 shadow-lg rounded-xl bg-gradient-to-r from-pink-500 to-rose-500 hover:scale-105 hover:shadow-pink-500/50">
                    ذخیره تغییرات
                </button>

            </form>
        </div>
    </div>
</x-app-layout>
