<div class="space-y-8">
    <!-- Welcome Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">سلام {{ $user->name }} 👋</h1>
            <p class="text-gray-500 dark:text-gray-400">خوش اومدی! وضعیت دارایی‌های شما به شرح زیر است.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('dashboard.buy') }}" class="px-5 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-yellow-500/20 text-sm">
                خرید دارایی
            </a>
        </div>
    </div>

    <!-- Portfolio Summary Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Portfolio Valuation Card -->
        <div class="p-6 bg-gradient-to-br from-yellow-400 via-yellow-500 to-yellow-600 rounded-3xl text-white shadow-xl shadow-yellow-500/20 relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
            <div class="flex items-center justify-between mb-4 relative z-10">
                <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-bold bg-white/20 px-3 py-1 rounded-full uppercase text-gray-950">کل دارایی‌ها</span>
            </div>
            <div class="space-y-1 text-right relative z-10">
                <p class="text-black text-xs">ارزش تخمینی کل سبد</p>
                <div class="flex items-baseline justify-end gap-2">
                    <span class="text-3xl font-extrabold font-mono">
                        {{ number_format($totalValueToman) }}
                    </span>
                    <span class="text-xs font-semibold text-yellow-100">تومان</span>
                </div>
            </div>
        </div>

        @foreach($wallets as $wallet)
            <div class="group p-6 bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 hover:border-yellow-500 dark:hover:border-yellow-500 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-yellow-50 dark:bg-yellow-900/20 flex items-center justify-center text-yellow-600 dark:text-yellow-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase">{{ $wallet->asset->symbol }}</span>
                </div>
                <div class="space-y-1 text-right">
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $wallet->asset->name }}</p>
                    <div class="flex items-baseline justify-end gap-2">
                        <span class="text-2xl font-bold text-gray-900 dark:text-white font-mono">
                            {{ number_format($wallet->balance, $wallet->asset->precision) }}
                        </span>
                        <span class="text-sm font-medium text-gray-500">{{ $wallet->asset->unit }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Recent Transactions & Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Transactions Table -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-800 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                <h3 class="font-bold text-gray-900 dark:text-white">تراکنش‌های اخیر</h3>
                <a href="#" class="text-xs text-yellow-600 dark:text-yellow-400 hover:underline">مشاهده همه</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead class="bg-gray-50 dark:bg-gray-800/50 text-gray-500 dark:text-gray-400 text-xs uppercase">
                        <tr>
                            <th class="px-6 py-3 font-medium">نوع</th>
                            <th class="px-6 py-3 font-medium">دارایی</th>
                            <th class="px-6 py-3 font-medium">مقدار</th>
                            <th class="px-6 py-3 font-medium">تاریخ</th>
                            <th class="px-6 py-3 font-medium">وضعیت</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($transactions as $tx)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-md text-[10px] font-bold {{ $tx->type === 'CREDIT' ? 'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400' }}">
                                        {{ $tx->type === 'CREDIT' ? 'واریز' : 'برداشت' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $tx->wallet->asset->symbol }}
                                </td>
                                <td class="px-6 py-4 text-sm font-mono">
                                    {{ number_format($tx->amount, 4) }}
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500 dark:text-gray-400">
                                    {{ $tx->created_at->format('Y/m/d') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="w-2 h-2 rounded-full bg-green-500 inline-block ml-2"></span>
                                    <span class="text-xs text-gray-600 dark:text-gray-400">تکمیل شده</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                    تراکنشی یافت نشد.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- User Info Card -->
        <div class="bg-white dark:bg-gray-900 p-6 rounded-3xl border border-gray-200 dark:border-gray-800 space-y-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-yellow-500 flex items-center justify-center text-white text-2xl font-bold">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div class="text-right">
                    <h3 class="font-bold text-gray-900 dark:text-white">{{ $user->name }}</h3>
                    <p class="text-xs text-gray-500">{{ $user->email }}</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex justify-between items-center p-3 rounded-2xl bg-gray-50 dark:bg-gray-800/50">
                    <span class="text-sm text-gray-500">وضعیت پروفایل</span>
                    @if($userProfileStatus['verified_at'])
                    <span class="text-xs font-bold text-green-500">تایید شده</span>
                    @else
                        <span class="text-xs font-bold text-yellow-500">تایید نشده</span>
                    @endif
                </div>
                <div class="flex justify-between items-center p-3 rounded-2xl bg-gray-50 dark:bg-gray-800/50">
                    <span class="text-sm text-gray-500">سطح دسترسی</span>
                    <span class="text-xs font-bold text-blue-500">کاربر عادی</span>
                </div>
            </div>

            <a href="{{ route('dashboard.setting.profile') }}" class="block w-full py-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-400 hover:text-yellow-600 dark:hover:text-yellow-400 transition-colors">
                ویرایش پروفایل &rarr;
            </a>
        </div>
    </div>
</div>
