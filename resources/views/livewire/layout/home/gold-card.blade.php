<div class="group bg-white dark:bg-gray-900 p-5 rounded-2xl border border-gray-200 dark:border-gray-800 hover:border-yellow-500 dark:hover:border-yellow-500 transition-all duration-300 hover:shadow-xl hover:shadow-yellow-500/10">
    <div class="flex justify-between items-start mb-6">
        <div class="space-y-1 text-right">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-yellow-600 dark:group-hover:text-yellow-400 transition-colors">{{ $item['name'] }}</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ $item['name_en'] }}</p>
        </div>
        <div class="text-left">
            <div class="text-xl font-bold text-gray-900 dark:text-white">
                {{ number_format($item['price']) }}
            </div>
            <div class="text-[10px] font-bold text-gray-400 uppercase">Toman</div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100 dark:border-gray-800">
        <div class="space-y-1 text-right">
            <span class="text-[10px] text-gray-400 block">میزان تغییر</span>
            <span class="text-xs font-bold {{ ($item['change_percent'] ?? 0) >= 0 ? 'text-green-500' : 'text-red-500' }}">
                {{ $item['change_percent'] }}%
            </span>
        </div>
        <div class="space-y-1 text-right">
            <span class="text-[10px] text-gray-400 block">نماد</span>
            <span class="text-xs font-bold text-gray-700 dark:text-gray-300">{{ $item['symbol'] }}</span>
        </div>
        <div class="space-y-1 text-right">
            <span class="text-[10px] text-gray-400 block">تاریخ</span>
            <span class="text-xs font-medium text-gray-600 dark:text-gray-400">{{ $item['date'] }}</span>
        </div>
        <div class="space-y-1 text-right">
            <span class="text-[10px] text-gray-400 block">ساعت</span>
            <span class="text-xs font-medium text-gray-600 dark:text-gray-400">{{ $item['time'] }}</span>
        </div>
    </div>
</div>
