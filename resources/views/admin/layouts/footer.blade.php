<footer class="bg-slate-900 border-t border-slate-700 text-white">
    <div class="max-w-7xl mx-auto px-4 py-3">

        <div class="flex flex-col lg:flex-row justify-between items-center gap-4">

            <div class="bg-slate-800 rounded-lg px-4 py-2">
                <div class="text-gray-400 text-xs mb-1">
                    خرید / فروش
                </div>

                <div class="text-sm">
                    <span class="text-green-400">
                        {{ number_format($gold['bid'], 2) }}
                    </span>

                    /

                    <span class="text-red-400">
                        {{ number_format($gold['ask'], 2) }}
                    </span>
                </div>
            </div>

            {{-- Gold Prices --}}
            <div class="flex flex-wrap gap-3">

                <div class="bg-slate-800 rounded-lg px-4 py-2">
                    <div class="text-gray-400 text-xs mb-1">
                        اونس جهانی
                    </div>

                    <div class="font-bold text-yellow-400">
                        {{ number_format($gold['price'], 2) }} $
                    </div>
                </div>

                <div class="bg-slate-800 rounded-lg px-4 py-2">
                    <div class="text-gray-400 text-xs mb-1">
                        طلای 24 عیار
                    </div>

                    <div class="font-bold text-yellow-400">
                        {{ number_format($gold['price_gram_24k'], 2) }} $
                    </div>
                </div>

                <div class="bg-slate-800 rounded-lg px-4 py-2">
                    <div class="text-gray-400 text-xs mb-1">
                        طلای 18 عیار
                    </div>

                    <div class="font-bold text-yellow-400">
                        {{ number_format($gold['price_gram_18k'], 2) }} $
                    </div>
                </div>

            </div>

            {{-- Market Status --}}
            <div class="flex items-center gap-2">

                <span class="text-sm text-gray-400">
                    تغییرات:
                </span>

                <span
                    class="
                        px-3 py-1 rounded-full text-sm font-semibold
                        {{ $gold['chp'] >= 0
                            ? 'bg-green-500/20 text-green-400'
                            : 'bg-red-500/20 text-red-400'
                        }}
                    "
                >
                    {{ $gold['chp'] >= 0 ? '+' : '' }}{{ $gold['chp'] }}%
                </span>

                <span class="text-xs text-gray-500">
                    ({{ $gold['ch'] >= 0 ? '+' : '' }}{{ $gold['ch'] }}$)
                </span>

            </div>

        </div>

    </div>
</footer>
