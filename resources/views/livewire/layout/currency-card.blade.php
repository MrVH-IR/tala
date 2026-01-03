<div class="relative flex flex-col h-full p-6 transition-all duration-500 border group bg-gradient-to-br from-gray-800/60 to-gray-900/60 backdrop-blur-xl rounded-2xl border-green-500/20 hover:border-green-500/50 hover:scale-105 hover:shadow-2xl hover:shadow-green-500/20">
    <!-- Icon / Symbol -->
    <div class="flex justify-center mb-4">
        <div class="flex items-center justify-center w-20 h-20 transition-all duration-500 rounded-full shadow-lg bg-gradient-to-br from-green-400 to-green-600 shadow-green-500/50 group-hover:shadow-green-500/80 group-hover:rotate-12">
            <span class="text-lg font-bold text-white">{{ $item['symbol'] }}</span>
        </div>
    </div>

    <!-- Title -->
    <h3 class="mb-2 text-xl font-bold text-center text-green-400 transition-colors duration-300 group-hover:text-green-300">
        {{ $item['name'] }}
    </h3>

    <!-- Price -->
    <p class="text-lg text-center text-white/80">
        {{ number_format($item['price']) }} {{ $item['unit'] }}
    </p>

    <!-- Change -->
    <p class="text-center mt-1 text-sm {{ $item['change_value'] < 0 ? 'text-red-400' : 'text-green-400' }}">
        {{ $item['change_percent'] }}%
    </p>

    <!-- Date / Time -->
    <p class="mt-1 text-xs text-center text-gray-400">
        {{ $item['date'] }} - {{ $item['time'] }}
    </p>
</div>
