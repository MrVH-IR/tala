<div class="lp-tilt group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 transition-all duration-300 hover:border-yellow-500 hover:shadow-xl hover:shadow-yellow-500/10 dark:border-gray-800 dark:bg-gray-900 dark:hover:border-yellow-500">
    <div class="pointer-events-none absolute -left-8 -top-8 h-28 w-28 rounded-full bg-yellow-400/10 opacity-0 blur-2xl transition-opacity duration-300 group-hover:opacity-100"></div>

    <div class="relative mb-6 flex items-start justify-between">
        <div class="space-y-1 text-right">
            <div class="flex items-center gap-2 justify-end">
                <h3 class="text-lg font-bold text-gray-900 transition-colors group-hover:text-yellow-600 dark:text-white dark:group-hover:text-yellow-400">{{ $item['name'] }}</h3>
                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-amber-600 text-white">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9" fill="currentColor" fill-opacity="0.25" />
                        <path d="M8 12h8M12 8v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                </span>
            </div>
            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ $item['name_en'] }}</p>
        </div>
        <div class="text-left">
            <div class="text-xl font-bold text-gray-900 dark:text-white">
                {{ number_format($item['price']) }}
            </div>
            <div class="text-[10px] font-bold uppercase text-gray-400">Toman</div>
        </div>
    </div>

    <div class="relative grid grid-cols-2 gap-4 border-t border-gray-100 pt-4 dark:border-gray-800">
        <div class="space-y-1 text-right">
            <span class="block text-[10px] text-gray-400">میزان تغییر</span>
            <span class="inline-flex items-center gap-0.5 rounded-full px-1.5 py-0.5 text-xs font-bold {{ ($item['change_percent'] ?? 0) >= 0 ? 'bg-green-50 text-green-600 dark:bg-green-500/10 dark:text-green-400' : 'bg-red-50 text-red-500 dark:bg-red-500/10 dark:text-red-400' }}">
                <svg class="h-2.5 w-2.5 {{ ($item['change_percent'] ?? 0) < 0 ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none">
                    <path d="M12 19V5M12 5l-6 6M12 5l6 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                {{ $item['change_percent'] }}%
            </span>
        </div>
        <div class="space-y-1 text-right">
            <span class="block text-[10px] text-gray-400">نماد</span>
            <span class="text-xs font-bold text-gray-700 dark:text-gray-300">{{ $item['symbol'] }}</span>
        </div>
        <div class="space-y-1 text-right">
            <span class="block text-[10px] text-gray-400">تاریخ</span>
            <span class="text-xs font-medium text-gray-600 dark:text-gray-400">{{ $item['date'] }}</span>
        </div>
        <div class="space-y-1 text-right">
            <span class="block text-[10px] text-gray-400">ساعت</span>
            <span class="text-xs font-medium text-gray-600 dark:text-gray-400">{{ $item['time'] }}</span>
        </div>
    </div>
</div>
