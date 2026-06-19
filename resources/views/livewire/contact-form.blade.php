<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">تماس با ما</h1>
        <p class="text-gray-600 dark:text-gray-400">از طریق فرم زیر با ما در ارتباط باشید. ما مشتاقانه منتظر پیام‌های شما هستیم.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Contact Info -->
        <div class="lg:col-span-1 space-y-8">
            <div class="p-6 bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-sm">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-yellow-500/10 rounded-2xl text-yellow-600 dark:text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502.//etc" />
                        </svg>
                        <!-- Simplified SVG for brevity, using a placeholder icon approach -->
                        <span class="text-xl">📧</span>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white">ایمیل</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">support@goldina.com</p>
            </div>

            <div class="p-6 bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-sm">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-yellow-500/10 rounded-2xl text-yellow-600 dark:text-yellow-500">
                        <span class="text-xl">📍</span>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white">آدرس</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">تهران، خیابان آزادی، مرکز تجاری گلدینا</p>
            </div>

            <div class="p-6 bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-sm">
                <div class="flex items-center gap-4 mb-4">
                    <div class="p-3 bg-yellow-500/10 rounded-2xl text-yellow-600 dark:text-yellow-500">
                        <span class="text-xl">📞</span>
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white">تلفن</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-400">۰۲۱-۱۲۳۴۵۶۷۸</p>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="lg:col-span-2">
            <div class="p-8 bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-xl">
                @if($successMessage)
                    <div class="mb-6 p-4 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 rounded-2xl text-center font-bold">
                        {{ $successMessage }}
                    </div>
                @endif

                <form wire:submit.prevent="submit" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">نام و نام خانوادگی</label>
                            <input type="text" wire:model="name" class="w-full px-4 py-3 rounded-2xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 outline-none transition" placeholder="مثلاً علی رضایی">
                            @error('name') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">ایمیل</label>
                            <input type="email" wire:model="email" class="w-full px-4 py-3 rounded-2xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 outline-none transition" placeholder="email@example.com">
                            @error('email') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">موضوع</label>
                        <input type="text" wire:model="subject" class="w-full px-4 py-3 rounded-2xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 outline-none transition" placeholder="موضوع پیام شما">
                        @error('subject') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">پیام</label>
                        <textarea wire:model="message" rows="5" class="w-full px-4 py-3 rounded-2xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 outline-none transition" placeholder="چطور می‌توانیم به شما کمک کنیم؟"></textarea>
                        @error('message') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full py-4 px-6 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-2xl transition duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-yellow-500/30">
                        ارسال پیام
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
