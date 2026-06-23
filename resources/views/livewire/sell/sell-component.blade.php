<div class="py-8">
    <div class="mx-auto max-w-4xl space-y-8">
        
        <!-- 🔴 Step 1: Asset Selection from Wallet -->
        <section class="space-y-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-red-500 text-white font-bold text-sm">۱</div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">انتخاب دارایی برای فروش</h3>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($wallets as $wallet)
                    <div 
                        wire:click="selectItem('{{ $wallet['symbol'] }}')"
                        class="group relative cursor-pointer p-5 rounded-3xl border-2 transition-all duration-300 
                        {{ $selectedSymbol === $wallet['symbol'] ? 'border-red-500 bg-red-50 dark:bg-red-900/20 shadow-md' : 'border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 hover:border-red-200 dark:hover:border-gray-700' }}"
                    >
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-400 dark:text-gray-500 mb-1">{{ $wallet['symbol'] }}</span>
                                <span class="font-bold text-gray-900 dark:text-white text-lg">{{ $wallet['name'] }}</span>
                            </div>
                            <div class="px-2 py-1 rounded-lg text-xs font-bold bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                {{ $wallet['category'] === 'gold' ? '🟡' : ($wallet['category'] === 'currency' ? '💵' : '🪙') }}
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between items-baseline">
                                <span class="text-xs text-gray-500 dark:text-gray-400">موجودی قابل فروش:</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ number_format($wallet['available'], 4) }}</span>
                            </div>
                            <div class="flex justify-between items-baseline">
                                <span class="text-xs text-gray-500 dark:text-gray-400">قیمت لحظه‌ای:</span>
                                <span class="font-bold text-red-600 dark:text-red-400">{{ number_format($wallet['price']) }} تومان</span>
                            </div>
                        </div>

                        @if($selectedSymbol === $wallet['symbol'])
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center shadow-sm ring-4 ring-white dark:ring-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center bg-gray-50 dark:bg-gray-900/50 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-800">
                        <span class="text-gray-500 dark:text-gray-400">شما هیچ دارایی قابل فروشی در کیف پول خود ندارید.</span>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- 🔵 Step 2: Sell Amount Calculation -->
        <section class="space-y-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-red-500 text-white font-bold text-sm">۲</div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">مقدار فروش</h3>
            </div>

            <div class="bg-white dark:bg-gray-900 p-8 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-xl space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Amount Input -->
                    <div class="space-y-2">
                        <div class="flex justify-between items-center mr-1">
                            <label class="text-sm font-medium text-gray-600 dark:text-gray-400">مقدار مورد نظر</label>
                            <span class="text-xs text-gray-400">حداکثر: {{ number_format($availableBalance, 4) }}</span>
                        </div>
                        <div class="relative">
                            <input 
                                type="text" 
                                wire:model.live.debounce.300ms="amount"
                                class="w-full px-4 py-4 rounded-2xl border-2 border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-red-500 focus:ring-0 transition-all outline-none text-lg font-semibold"
                                placeholder="مثلاً ۰.۵"
                            />
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        @error('amount') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Quick Select Amounts -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-600 dark:text-gray-400 mr-1">انتخاب سریع</label>
                        <div class="grid grid-cols-4 gap-2">
                            @php
                                $percentages = [25, 50, 75, 100];
                            @endphp
                            @foreach($percentages as $pct)
                                <button 
                                    wire:click="$set('amount', {{ $availableBalance * ($pct/100) }})"
                                    class="py-2 px-1 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 text-xs font-bold text-gray-600 dark:text-gray-400 hover:border-red-500 hover:text-red-500 transition-all"
                                >
                                    {{ $pct }}%
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Price Summary -->
                <div class="p-6 rounded-2xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 space-y-4">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-400">قیمت فروش هر واحد:</span>
                        <span class="font-bold text-gray-900 dark:text-white">{{ number_format($selectedPrice) }} تومان</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                        <span class="text-lg font-bold text-gray-900 dark:text-white">مبلغ دریافتی تخمینی:</span>
                        <div class="text-2xl font-black text-green-600 dark:text-green-500">
                            {{ number_format($total) }} <span class="text-sm font-medium">تومان</span>
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <button 
                    wire:click="processSale"
                    wire:loading.attr="disabled"
                    class="w-full py-5 px-6 bg-red-500 hover:bg-red-600 disabled:bg-gray-400 text-white font-black text-xl rounded-2xl transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-red-500/30 flex items-center justify-center gap-3"
                >
                    <span wire:loading.remove>ثبت درخواست فروش</span>
                    <span wire:loading>در حال پردازش...</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>
            </div>
        </section>
    </div>
</div>
