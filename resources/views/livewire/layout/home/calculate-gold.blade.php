<div class="lp-glass-light relative space-y-6 overflow-hidden rounded-3xl border border-gray-200/70 p-6 shadow-[0_20px_60px_rgba(0,0,0,0.06)] dark:border-gray-800/70">

    {{-- درخشش زینتی گوشه --}}
    <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-yellow-400/15 blur-3xl"></div>

    <div class="relative mb-2 flex items-center gap-3">
        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-amber-600 text-white shadow-[0_6px_16px_rgba(217,158,10,0.35)]">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">محاسبه مقدار طلا</h3>
    </div>

    <div class="relative space-y-4">
        <div class="space-y-2">
            <label class="block text-right text-sm font-medium text-gray-500 dark:text-gray-400">هزینه طلا (تومان)</label>
            <div class="relative">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="amount"
                    inputmode="numeric"
                    class="w-full rounded-xl border border-gray-200 bg-white/60 px-4 py-3 text-right text-gray-900 outline-none transition-all focus:border-transparent focus:bg-white focus:ring-2 focus:ring-yellow-500 dark:border-gray-700 dark:bg-gray-800/60 dark:text-white dark:focus:bg-gray-800"
                    placeholder="مثلا ۱,۰۰۰,۰۰۰"
                />
                <div class="absolute left-3 top-1/2 -translate-y-1/2 rounded-md bg-gray-100 px-1.5 py-0.5 text-[10px] font-bold text-gray-400 dark:bg-gray-800 dark:text-gray-500">Toman</div>
            </div>
        </div>

        <div class="space-y-2">
            <label class="block text-right text-sm font-medium text-gray-500 dark:text-gray-400">وزن تخمینی (گرم)</label>
            <div class="relative">
                <input
                    type="text"
                    readonly
                    value="{{ $weight }}"
                    class="w-full cursor-not-allowed rounded-xl border border-dashed border-gray-200 bg-gray-50/80 px-4 py-3 text-right font-mono text-gray-500 outline-none transition-all dark:border-gray-800 dark:bg-gray-900/60 dark:text-gray-400"
                />
                <div class="absolute left-3 top-1/2 -translate-y-1/2 rounded-md bg-gray-100 px-1.5 py-0.5 text-[10px] font-bold text-gray-400 dark:bg-gray-800 dark:text-gray-500">Gram</div>
            </div>
        </div>
    </div>

    <div class="relative border-t border-gray-100 pt-4 dark:border-gray-800">
        <div class="flex items-center justify-between text-sm">
            <span class="text-gray-500 dark:text-gray-400">قیمت گرم ۱۸ عیار:</span>
            <span class="font-bold text-gray-900 dark:text-white">
                {{ number_format($gold18Price) }} <span class="text-xs font-normal text-gray-400">تومان</span>
            </span>
        </div>
    </div>

    <div class="relative text-center">
        <span wire:loading class="inline-flex items-center gap-2 rounded-full bg-yellow-50 px-3 py-1.5 text-xs text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-400">
            <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.291z"></path>
            </svg>
            در حال به‌روزرسانی قیمت‌ها...
        </span>
    </div>
</div>
