<div class="group bg-white dark:bg-gray-900 p-5 rounded-2xl border border-gray-200 dark:border-gray-800 hover:border-blue-500 dark:hover:border-blue-500 transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/10">
    <div class="flex items-center justify-between mb-4">
        <div class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold text-xs">
            {{ $item['symbol'] }}
        </div>
        <div class="text-left">
            <div class="text-lg font-bold text-gray-900 dark:text-white">
                {{ number_format($item['price']) }}
            </div>
            <div class="text-[10px] font-bold text-gray-400 uppercase">{{ $item['unit'] }}</div>
        </div>
    </div>
    <div class="space-y-3 text-right">
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">نام ارز</span>
            <span class="text-sm font-bold text-gray-800 dark:text-gray-200">{{ $item['name'] }}</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">تغییرات</span>
            <span class="text-xs font-bold {{ ($item['change_value'] ?? 0) >= 0 ? 'text-green-500' : 'text-red-500' }}">
                {{ $item['change_percent'] }}%
            </span>
        </div>
        <div class="pt-2 border-t border-gray-100 dark:border-gray-800 flex justify-between items-center">
            <span class="text-[10px] text-gray-400">{{ $item['date'] }}</span>
            <span class="text-[10px] text-gray-400">{{ $item['time'] }}</span>
        </div>
    </div>
</div>
