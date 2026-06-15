<div class="bg-white dark:bg-gray-900 p-6 rounded-3xl shadow-sm border border-gray-200 dark:border-gray-800 space-y-6">
    <div class="flex items-center gap-3 mb-2">
        <div class="w-10 h-10 bg-yellow-500/10 dark:bg-yellow-500/20 rounded-full flex items-center justify-center text-yellow-600 dark:text-yellow-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">محاسبه مقدار طلا</h3>
    </div>

    <div class="space-y-4">
        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 block text-right">هزینه طلا (تومان)</label>
            <div class="relative">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="amount"
                    inputmode="numeric"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-yellow-500 focus:border-transparent outline-none transition-all text-right"
                    placeholder="مثلا ۱,۰۰۰,۰۰۰"
                />
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-400">Toman</div>
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 block text-right">وزن تخمینی (گرم)</label>
            <div class="relative">
                <input
                    type="text"
                    readonly
                    value="{{ $weight }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-900 text-gray-500 dark:text-gray-400 cursor-not-allowed outline-none transition-all text-right font-mono"
                />
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-gray-400">Gram</div>
            </div>
        </div>
    </div>

    <div class="pt-4 border-t border-gray-100 dark:border-gray-800">
        <div class="flex items-center justify-between text-sm">
            <span class="text-gray-500 dark:text-gray-400">قیمت گرم ۱۸ عیار:</span>
            <span class="font-bold text-gray-900 dark:text-white">
                {{ number_format($gold18Price) }} <span class="text-xs font-normal">تومان</span>
            </span>
        </div>
    </div>

    <div class="text-center">
        <span wire:loading class="inline-flex items-center gap-2 text-xs text-yellow-600 dark:text-yellow-400 animate-pulse">
            <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.291z"></path>
            </svg>
            در حال به‌روزرسانی قیمت‌ها...
        </span>
    </div>
</div>
