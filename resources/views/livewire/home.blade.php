<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 space-y-12">

    <!-- Market Ticker -->
    <div class="relative overflow-hidden rounded-2xl border border-gray-200/70 bg-white/80 py-3 shadow-[0_8px_30px_rgba(0,0,0,0.04)] backdrop-blur-xl dark:border-gray-800/70 dark:bg-gray-900/60 dark:shadow-[0_8px_30px_rgba(0,0,0,0.25)]">

        {{-- نشانگر زنده --}}
        <div class="pointer-events-none absolute right-4 top-1/2 z-20 hidden -translate-y-1/2 items-center gap-1.5 rounded-full border border-gray-200/70 bg-white/90 px-2.5 py-1 backdrop-blur-md dark:border-gray-700/70 dark:bg-gray-900/90 sm:flex">
        <span class="relative flex h-1.5 w-1.5">
            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-500 opacity-75"></span>
            <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-green-500"></span>
        </span>
            <span class="text-[10px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">زنده</span>
        </div>

        {{-- محو شدن گرادیانی دو لبه --}}
        <div class="pointer-events-none absolute inset-y-0 left-0 z-10 w-16 bg-gradient-to-r from-white to-transparent dark:from-gray-900"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 z-10 w-16 bg-gradient-to-l from-white to-transparent dark:from-gray-900"></div>

        <div class="flex whitespace-nowrap animate-marquee">
            <div class="flex items-center gap-1 px-4">
                @foreach($gold as $item)
                    <div class="flex items-center gap-2.5 rounded-xl px-3 py-1.5 text-sm font-medium transition-colors hover:bg-yellow-50 dark:hover:bg-yellow-500/5">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-amber-600 text-[10px] font-bold text-white shadow-[0_2px_8px_rgba(217,158,10,0.4)]">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="9" fill="currentColor" fill-opacity="0.25" />
                            <path d="M8 12h8M12 8v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                    </span>
                        <span class="text-gray-500 dark:text-gray-400">{{ $item['symbol'] }}</span>
                        <span class="font-semibold text-yellow-700 dark:text-yellow-400">{{ number_format($item['price']) }}</span>
                        <span class="flex items-center gap-0.5 rounded-full px-1.5 py-0.5 text-xs font-semibold {{ ($item['change_percent'] ?? 0) >= 0 ? 'bg-green-50 text-green-600 dark:bg-green-500/10 dark:text-green-400' : 'bg-red-50 text-red-500 dark:bg-red-500/10 dark:text-red-400' }}">
                        <svg class="h-3 w-3 {{ ($item['change_percent'] ?? 0) < 0 ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none">
                            <path d="M12 19V5M12 5l-6 6M12 5l6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        {{ $item['change_percent'] ?? 0 }}%
                    </span>
                        <span class="h-4 w-px bg-gray-200 dark:bg-gray-700"></span>
                    </div>
                @endforeach
                @foreach($currency as $item)
                    <div class="flex items-center gap-2.5 rounded-xl px-3 py-1.5 text-sm font-medium transition-colors hover:bg-blue-50 dark:hover:bg-blue-500/5">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-blue-400 to-indigo-600 text-[10px] font-bold text-white shadow-[0_2px_8px_rgba(59,130,246,0.4)]">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none">
                            <path d="M7 15c0 1.66 2.24 3 5 3s5-1.34 5-3-2.24-2.5-5-3-5-1.34-5-3 2.24-3 5-3 5 1.34 5 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                    </span>
                        <span class="text-gray-500 dark:text-gray-400">{{ $item['symbol'] }}</span>
                        <span class="font-semibold text-blue-700 dark:text-blue-400">{{ number_format($item['price']) }}</span>
                        <span class="flex items-center gap-0.5 rounded-full px-1.5 py-0.5 text-xs font-semibold {{ ($item['change_value'] ?? 0) >= 0 ? 'bg-green-50 text-green-600 dark:bg-green-500/10 dark:text-green-400' : 'bg-red-50 text-red-500 dark:bg-red-500/10 dark:text-red-400' }}">
                        <svg class="h-3 w-3 {{ ($item['change_value'] ?? 0) < 0 ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none">
                            <path d="M12 19V5M12 5l-6 6M12 5l6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        {{ $item['change_percent'] ?? 0 }}%
                    </span>
                        <span class="h-4 w-px bg-gray-200 dark:bg-gray-700"></span>
                    </div>
                @endforeach
            </div>
            <!-- Duplicate for seamless loop -->
            <div class="flex items-center gap-1 px-4">
                @foreach($gold as $item)
                    <div class="flex items-center gap-2.5 rounded-xl px-3 py-1.5 text-sm font-medium transition-colors hover:bg-yellow-50 dark:hover:bg-yellow-500/5">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-yellow-400 to-amber-600 text-[10px] font-bold text-white shadow-[0_2px_8px_rgba(217,158,10,0.4)]">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="9" fill="currentColor" fill-opacity="0.25" />
                            <path d="M8 12h8M12 8v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                    </span>
                        <span class="text-gray-500 dark:text-gray-400">{{ $item['symbol'] }}</span>
                        <span class="font-semibold text-yellow-700 dark:text-yellow-400">{{ number_format($item['price']) }}</span>
                        <span class="flex items-center gap-0.5 rounded-full px-1.5 py-0.5 text-xs font-semibold {{ ($item['change_percent'] ?? 0) >= 0 ? 'bg-green-50 text-green-600 dark:bg-green-500/10 dark:text-green-400' : 'bg-red-50 text-red-500 dark:bg-red-500/10 dark:text-red-400' }}">
                        <svg class="h-3 w-3 {{ ($item['change_percent'] ?? 0) < 0 ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none">
                            <path d="M12 19V5M12 5l-6 6M12 5l6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        {{ $item['change_percent'] ?? 0 }}%
                    </span>
                        <span class="h-4 w-px bg-gray-200 dark:bg-gray-700"></span>
                    </div>
                @endforeach
                @foreach($currency as $item)
                    <div class="flex items-center gap-2.5 rounded-xl px-3 py-1.5 text-sm font-medium transition-colors hover:bg-blue-50 dark:hover:bg-blue-500/5">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-blue-400 to-indigo-600 text-[10px] font-bold text-white shadow-[0_2px_8px_rgba(59,130,246,0.4)]">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none">
                            <path d="M7 15c0 1.66 2.24 3 5 3s5-1.34 5-3-2.24-2.5-5-3-5-1.34-5-3 2.24-3 5-3 5 1.34 5 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                    </span>
                        <span class="text-gray-500 dark:text-gray-400">{{ $item['symbol'] }}</span>
                        <span class="font-semibold text-blue-700 dark:text-blue-400">{{ number_format($item['price']) }}</span>
                        <span class="flex items-center gap-0.5 rounded-full px-1.5 py-0.5 text-xs font-semibold {{ ($item['change_value'] ?? 0) >= 0 ? 'bg-green-50 text-green-600 dark:bg-green-500/10 dark:text-green-400' : 'bg-red-50 text-red-500 dark:bg-red-500/10 dark:text-red-400' }}">
                        <svg class="h-3 w-3 {{ ($item['change_value'] ?? 0) < 0 ? 'rotate-180' : '' }}" viewBox="0 0 24 24" fill="none">
                            <path d="M12 19V5M12 5l-6 6M12 5l6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        {{ $item['change_percent'] ?? 0 }}%
                    </span>
                        <span class="h-4 w-px bg-gray-200 dark:bg-gray-700"></span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="relative grid grid-cols-1 items-center gap-12 lg:grid-cols-2">

        {{-- درخشش‌های محیطی پس‌زمینه --}}
        <div class="pointer-events-none absolute -top-20 right-0 -z-10 h-96 w-96 rounded-full bg-yellow-400/10 blur-[100px] dark:bg-yellow-500/10"></div>
        <div class="pointer-events-none absolute bottom-0 left-0 -z-10 h-72 w-72 rounded-full bg-amber-500/10 blur-[90px]"></div>

        <div class="space-y-8 text-right">
        <span class="inline-flex items-center gap-1.5 rounded-full border border-yellow-500/20 bg-yellow-50 px-3 py-1 text-xs font-semibold text-yellow-700 dark:border-yellow-500/20 dark:bg-yellow-500/10 dark:text-yellow-400">
            <span class="relative flex h-1.5 w-1.5">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-yellow-500 opacity-75"></span>
                <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-yellow-500"></span>
            </span>
            قیمت لحظه‌ای بازار طلا و ارز
        </span>

            <h1 class="text-4xl font-bold leading-tight text-gray-900 dark:text-white md:text-6xl">
                سرمایه‌گذاری هوشمند در
                <span class="relative inline-block">
                <span class="relative z-10 bg-gradient-to-l from-yellow-500 to-amber-600 bg-clip-text text-transparent">طلای آب شده</span>
                <span class="absolute inset-x-0 bottom-1 -z-0 h-3 rounded bg-yellow-400/20 dark:bg-yellow-500/20"></span>
            </span>
            </h1>

            <p class="max-w-2xl ml-auto text-lg leading-relaxed text-gray-600 dark:text-gray-400">
                با گلدینا، سریع‌ترین و امن‌ترین راه برای خرید و فروش طلای آب شده را تجربه کنید. قیمت‌های لحظه‌ای، تراکنش‌های آنی و شفافیت کامل در هر معامله.
            </p>

            <div class="flex justify-end gap-4">
                <a href="#market" class="group relative overflow-hidden rounded-xl bg-gradient-to-l from-yellow-500 to-amber-600 px-8 py-4 font-bold text-white shadow-lg shadow-yellow-500/25 transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-yellow-500/35">
                    <span class="relative z-10">مشاهده قیمت‌ها</span>
                    <span class="absolute inset-0 -translate-x-full bg-white/20 transition-transform duration-500 group-hover:translate-x-0"></span>
                </a>
                <a href="#calculate" class="rounded-xl border border-gray-200 bg-white px-8 py-4 font-semibold text-gray-900 backdrop-blur-md transition-all hover:-translate-y-0.5 hover:bg-gray-50 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800/80 dark:text-white dark:hover:bg-gray-700">
                    محاسبه مقدار طلا
                </a>
            </div>
        </div>

        <div class="relative flex justify-center">
            {{-- حلقه‌های درخشان دوار پشت تصویر --}}
            <div class="pointer-events-none absolute -z-10 h-80 w-80 rounded-full bg-gradient-to-br from-yellow-400/25 via-amber-500/15 to-transparent blur-3xl"></div>
            <div class="pointer-events-none absolute -z-10 h-72 w-72 rounded-full border border-yellow-500/20 [animation:spin_18s_linear_infinite]"></div>
            <div class="pointer-events-none absolute -z-10 h-56 w-56 rounded-full border border-dashed border-yellow-500/15 [animation:spin_24s_linear_infinite_reverse]"></div>

            {{-- ذرات طلایی شناور --}}
            <span class="pointer-events-none absolute left-6 top-8 h-2 w-2 rounded-full bg-yellow-400 shadow-[0_0_12px_rgba(234,179,8,0.7)] [animation:bounce_3s_ease-in-out_infinite]"></span>
            <span class="pointer-events-none absolute bottom-10 right-4 h-1.5 w-1.5 rounded-full bg-amber-500 shadow-[0_0_10px_rgba(217,119,6,0.7)] [animation:bounce_4s_ease-in-out_infinite]"></span>
            <span class="pointer-events-none absolute right-10 top-1/3 h-1 w-1 rounded-full bg-yellow-300 shadow-[0_0_8px_rgba(253,224,71,0.7)] [animation:bounce_2.5s_ease-in-out_infinite]"></span>

            <div class="relative z-10 drop-shadow-[0_20px_50px_rgba(217,158,10,0.25)]">
                @include('livewire.layout.home.gold-piece')
            </div>

            <!-- Decorative Background -->
            <div class="absolute -z-10 h-72 w-72 rounded-full bg-yellow-500/20 blur-3xl"></div>
        </div>
    </div>

    <div id="features" class="py-12">
        @include('livewire.layout.home.cards')
    </div>

    <!-- Calculator & Market Section -->
    <div id="market" class="grid grid-cols-1 gap-12 lg:grid-cols-3">
        <!-- Calculator Widget -->
        <div id="calculate" class="lg:col-span-1">
            <div class="sticky top-8">
                @include('livewire.layout.home.calculate-gold')
            </div>
        </div>

        <!-- Market Prices Grid -->
        <div class="space-y-8 lg:col-span-2">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">قیمت‌های لحظه‌ای بازار</h2>
                    <p class="mt-1 text-sm text-gray-400 dark:text-gray-500">به‌روزرسانی خودکار هر چند ثانیه</p>
                </div>
                <div class="flex gap-2">
                <span class="flex items-center gap-1.5 rounded-full bg-gradient-to-l from-yellow-400 to-amber-500 px-3 py-1 text-xs font-bold text-white shadow-[0_4px_14px_rgba(217,158,10,0.3)]">
                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9" fill="currentColor" fill-opacity="0.3" />
                        <path d="M8 12h8M12 8v8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                    طلا
                </span>
                    <span class="flex items-center gap-1.5 rounded-full bg-gradient-to-l from-blue-400 to-indigo-500 px-3 py-1 text-xs font-bold text-white shadow-[0_4px_14px_rgba(59,130,246,0.3)]">
                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none">
                        <path d="M7 15c0 1.66 2.24 3 5 3s5-1.34 5-3-2.24-2.5-5-3-5-1.34-5-3 2.24-3 5-3 5 1.34 5 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                    ارز
                </span>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
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

