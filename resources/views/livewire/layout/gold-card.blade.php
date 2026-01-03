<div
    x-data="{ open: false }"
    class="relative flex flex-col h-full transition-all duration-500 border bg-gradient-to-br from-gray-800/60 to-gray-900/60 backdrop-blur-xl rounded-2xl border-yellow-500/20 hover:border-yellow-500/50 hover:shadow-2xl hover:shadow-yellow-500/20"
>
    <!-- Header -->
    <button
        @click="open = !open"
        class="flex items-center justify-between w-full p-6 text-right"
    >
        <div>
            <h3 class="text-lg font-bold text-yellow-400">
                {{ $item['name'] }}
            </h3>
            <p class="text-sm text-gray-400">
                {{ $item['name_en'] }}
            </p>
        </div>

        <div class="text-left">
            <p class="text-xl font-bold text-white">
                {{ number_format($item['price']) }}
                <span class="text-sm text-gray-400">{{ $item['unit'] }}</span>
            </p>

            <p
                class="text-sm font-semibold"
                :class="{
                    'text-green-400': {{ $item['change_percent'] }} > 0,
                    'text-red-400': {{ $item['change_percent'] }} < 0
                }"
            >
                {{ $item['change_percent'] }}%
            </p>
        </div>
    </button>

    <!-- Body -->
    <div
        x-show="open"
        x-collapse
        class="px-6 pb-6"
    >
        <div class="grid grid-cols-2 gap-4 mt-4 text-sm text-gray-300">

            <div>
                <span class="block text-gray-400">میزان تغییر</span>
                <span class="font-semibold">
                    {{ number_format($item['change_value']) }}
                    {{ $item['unit'] }}
                </span>
            </div>

            <div>
                <span class="block text-gray-400">نماد</span>
                <span class="font-semibold">
                    {{ $item['symbol'] }}
                </span>
            </div>

            <div>
                <span class="block text-gray-400">تاریخ</span>
                <span class="font-semibold">
                    {{ $item['date'] }}
                </span>
            </div>

            <div>
                <span class="block text-gray-400">ساعت</span>
                <span class="font-semibold">
                    {{ $item['time'] }}
                </span>
            </div>

        </div>
    </div>
</div>
