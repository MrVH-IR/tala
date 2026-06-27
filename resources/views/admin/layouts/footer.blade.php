<footer class="bg-slate-900 border-t border-slate-700">
    <div class="max-w-7xl mx-auto px-4 py-3">

        <div class="flex flex-wrap items-center justify-center gap-3">

            @foreach($gold as $item)
                <div
                    class="min-w-[145px] rounded-xl border border-slate-700 bg-slate-800 px-4 py-3
                           hover:bg-slate-750 transition">

                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-slate-400">
                            {{ $item['name'] }}
                        </span>

                        <span class="text-[11px] text-slate-500">
                            {{ $item['symbol'] }}
                        </span>
                    </div>

                    <div class="text-lg font-bold text-amber-400">
                        {{ number_format($item['price'], 2) }}
                    </div>

                    <div class="mt-1 text-xs text-slate-500">
                        {{ $item['currencySymbol'] }}
                        {{ $item['currency'] }}
                    </div>

                </div>
            @endforeach

        </div>

    </div>
</footer>
