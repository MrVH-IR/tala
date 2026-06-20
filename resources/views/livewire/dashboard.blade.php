<div class="space-y-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                سلام {{ $user->name }} 👋
            </h1>
            <p class="text-gray-500 dark:text-gray-400">
                وضعیت دارایی‌های شما به شرح زیر است.
            </p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('dashboard.buy') }}"
               class="px-5 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-yellow-500/20 text-sm">
                خرید دارایی
            </a>
        </div>
    </div>

    <!-- 💰 TOTAL WALLET (top) -->
    <div class="p-6 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-3xl">
        <div class="text-sm opacity-80">ارزش کل دارایی‌ها</div>
        <div class="text-3xl font-bold">
            {{ number_format($totalValueToman) }} تومان
        </div>
    </div>

    <!-- 🧱 WALLET GRID (4 columns) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        @foreach($wallets as $wallet)
            @php
                $market = $wallet->market_data ?? null;

                $price = $market['price'] ?? 0;
                $balance = (float) $wallet->balance;

                $value = $balance * $price;
            @endphp

            <div class="group p-4 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 hover:border-yellow-500 transition-all duration-300">

                <!-- header -->
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs text-gray-400 uppercase">
                        {{ $wallet->asset->symbol }}
                    </span>

                    @if($market)
                        <span class="text-[10px] px-2 py-0.5 rounded
                            {{ $market['change_percent'] >= 0
                                ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400'
                                : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'
                            }}">
                            {{ $market['change_percent'] }}%
                        </span>
                    @endif
                </div>

                <!-- name -->
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                    {{ $wallet->asset->name }}
                </p>

                <!-- balance -->
                <div class="mt-2 flex justify-end">
                    <span class="text-lg font-bold text-gray-900 dark:text-white font-mono">
                        {{ number_format($balance, 8) }}
                    </span>
                </div>

                <!-- value -->
                <div class="text-yellow-500 font-bold text-sm mt-1 text-right">
                    {{ number_format($value) }} تومان
                </div>

            </div>

        @endforeach

    </div>

    <!-- 📊 TRANSACTIONS -->
    <div class="bg-white dark:bg-gray-900 rounded-3xl overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex justify-between">
            <h3 class="font-bold text-gray-900 dark:text-white">تراکنش‌ها</h3>
            <a href="#" class="text-xs text-yellow-600 hover:underline">مشاهده همه</a>
        </div>

        <table class="w-full text-right">
            <thead class="bg-gray-50 dark:bg-gray-800/50 text-gray-500 text-xs uppercase">
            <tr>
                <th class="p-3">نوع</th>
                <th class="p-3">دارایی</th>
                <th class="p-3">مقدار</th>
                <th class="p-3">تاریخ</th>
            </tr>
            </thead>

            <tbody>
            @forelse($transactions as $tx)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50">

                    <td class="p-3">
                            <span class="text-[10px] px-2 py-1 rounded
                                {{ $tx->type === 'CREDIT'
                                    ? 'bg-green-100 text-green-800'
                                    : 'bg-red-100 text-red-600' }}">
                                {{ $tx->type === 'CREDIT' ? 'واریز' : 'برداشت' }}
                            </span>
                    </td>

                    <td class="p-3 text-sm">
                        {{ $tx->wallet->asset->symbol ?? '-' }}
                    </td>

                    <td class="p-3 font-mono">
                        {{ number_format($tx->amount, 4) }}
                    </td>

                    <td class="p-3 text-xs text-gray-500">
                        {{ $tx->created_at->format('Y/m/d') }}
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-400">
                        تراکنشی یافت نشد
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">
            {{ $transactions->links() }}
        </div>

    </div>

</div>
