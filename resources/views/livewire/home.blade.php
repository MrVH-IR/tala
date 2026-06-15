<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 space-y-12">
    
    <!-- Market Ticker -->
    <div class="relative overflow-hidden bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 py-3">
        <div class="flex whitespace-nowrap animate-marquee">
            <div class="flex gap-8 px-4">
                @foreach ($gold as $item)
                    <div class="flex items-center gap-2 text-sm font-medium">
                        <span class="text-gray-500 dark:text-gray-400">{{ $item['symbol'] }}</span>
                        <span class="text-yellow-600 dark:text-yellow-400">{{ number_format($item['price']) }}</span>
                        <span class="{{ ($item['change_percent'] ?? 0) >= 0 ? 'text-green-500' : 'text-red-500' }} text-xs">
                            {{ ($item['change_percent'] ?? 0) }}%
                        </span>
                    </div>
                @endforeach
                @foreach ($currency as $item)
                    <div class="flex items-center gap-2 text-sm font-medium">
                        <span class="text-gray-500 dark:text-gray-400">{{ $item['symbol'] }}</span>
                        <span class="text-blue-600 dark:text-blue-400">{{ number_format($item['price']) }}</span>
                        <span class="{{ ($item['change_value'] ?? 0) >= 0 ? 'text-green-500' : 'text-red-500' }} text-xs">
                            {{ ($item['change_percent'] ?? 0) }}%
                        </span>
                    </div>
                @endforeach
            </div>
            <!-- Duplicate for seamless loop -->
            <div class="flex gap-8 px-4">
                @foreach ($gold as $item)
                    <div class="flex items-center gap-2 text-sm font-medium">
                        <span class="text-gray-500 dark:text-gray-400">{{ $item['symbol'] }}</span>
                        <span class="text-yellow-600 dark:text-yellow-400">{{ number_format($item['price']) }}</span>
                        <span class="{{ ($item['change_percent'] ?? 0) >= 0 ? 'text-green-500' : 'text-red-500' }} text-xs">
                            {{ ($item['change_percent'] ?? 0) }}%
                        </span>
                    </div>
                @endforeach
                @foreach ($currency as $item)
                    <div class="flex items-center gap-2 text-sm font-medium">
                        <span class="text-gray-500 dark:text-gray-400">{{ $item['symbol'] }}</span>
                        <span class="text-blue-600 dark:text-blue-400">{{ number_format($item['price']) }}</span>
                        <span class="{{ ($item['change_value'] ?? 0) >= 0 ? 'text-green-500' : 'text-red-500' }} text-xs">
                            {{ ($item['change_percent'] ?? 0) }}%
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-8 text-right">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight text-gray-900 dark:text-white">
                سرمایه‌گذاری هوشمند در <span class="text-yellow-500">طلای آب شده</span>
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl ml-auto">
                با گلدینا، سریع‌ترین و امن‌ترین راه برای خرید و فروش طلای آب شده را تجربه کنید. قیمت‌های لحظه‌ای، تراکنش‌های آنی و شفافیت کامل در هر معامله.
            </p>
            <div class="flex gap-4 justify-end">
                <a href="#market" class="px-8 py-4 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-yellow-500/20">
                    مشاهده قیمت‌ها
                </a>
                <a href="#calculate" class="px-8 py-4 bg-white dark:bg-gray-800 text-gray-900 dark:text-white font-semibold rounded-xl border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                    محاسبه مقدار طلا
                </a>
            </div>
        </div>
        <div class="flex justify-center relative">
            @include('livewire.layout.home.gold-piece')
            <!-- Decorative Background -->
            <div class="absolute -z-10 w-72 h-72 bg-yellow-500/20 blur-3xl rounded-full"></div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-12">
        @include('livewire.layout.home.cards')
    </div>

    <!-- Calculator & Market Section -->
    <div id="market" class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Calculator Widget -->
        <div id="calculate" class="lg:col-span-1">
            <div class="sticky top-8">
                @include('livewire.layout.home.calculate-gold')
            </div>
        </div>

        <!-- Market Prices Grid -->
        <div class="lg:col-span-2 space-y-8">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">قیمت‌های لحظه‌ای بازار</h2>
                <div class="flex gap-2">
                    <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 text-xs font-bold rounded-full">طلا</span>
                    <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-bold rounded-full">ارز</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($gold as $item)
                    @include('livewire.layout.home.gold-card', ['item' => $item])
                @endforeach
                @foreach ($currency as $item)
                    @include('livewire.layout.home.currency-card', ['item' => $item])
                @endforeach
            </div>
        </div>
    </div>
</div>

