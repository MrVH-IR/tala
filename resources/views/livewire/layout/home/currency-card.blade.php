<div class="lp-tilt group relative overflow-hidden rounded-2xl border border-gray-200 bg-white p-5 transition-all duration-300 hover:border-blue-500 hover:shadow-xl hover:shadow-blue-500/10 dark:border-gray-800 dark:bg-gray-900 dark:hover:border-blue-500">
    <div class="pointer-events-none absolute -left-8 -top-8 h-28 w-28 rounded-full bg-blue-400/10 opacity-0 blur-2xl transition-opacity duration-300 group-hover:opacity-100"></div>

    <div class="relative mb-4 flex items-center justify-between">
        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-400 to-indigo-600 text-xs font-bold text-white shadow-[0_4px_12px_rgba(59,130,246,0.35)] transition-transform duration-300 group-hover:scale-110">
            {{ $item['symbol'] }}
        </div>
        <div class="text-left">
            <div class="text-lg font-bold text-gray-900 dark:text-white">
                {{ number_format($item['price']) }}
            </div>
            <div class="text-[10px] font-bold uppercase text-gray-400">{{ $item['unit'] }}</div>
        </div>
    </div>

    <div class="relative space-y-3 text-right">
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">نام ارز</span>
            <span class="text-sm font-bold text-gray-800 dark:text-gray-200">{{ $item['name'] }}</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">تغییرات</span>
            <span class="inline-flex items-center gap-0.5 rounded-full px-1.5 py-0.5 text-xs font-bold {{ ($item['change_value'] ?? 0) >= 0 ? 'bg-green-50 text-green-600 dark:bg-green-500/10 dark:text-green-400' : 'bg-red-50 text-red-500 dark:bg-red-500/10 dark:text-red-400' }}">
                <svg class="h-2.5 w-2.5 {{ ($item['change_value'] ?? 0) < 0 ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none">
                    <path d="M12 19V5M12 5l-6 6M12 5l6 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                {{ $item['change_percent'] }}%
            </span>
        </div>
        <div class="flex items-center justify-between border-t border-gray-100 pt-2 dark:border-gray-800">
            <span class="text-[10px] text-gray-400">{{ $item['date'] }}</span>
            <span class="text-[10px] text-gray-400">{{ $item['time'] }}</span>
        </div>
    </div>
</div>
