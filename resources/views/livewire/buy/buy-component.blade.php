<div class="py-8">
    <div class="mx-auto max-w-4xl space-y-8">
        
        <!-- 🟢 Step 1: Category Selection -->
        <section class="space-y-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-yellow-500 text-white font-bold text-sm">۱</div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">انتخاب نوع دارایی</h3>
            </div>
            
            <div class="grid grid-cols-3 gap-4">
                <!-- Gold -->
                <button 
                    wire:click="$set('category', 'gold')"
                    class="relative group overflow-hidden p-4 rounded-3xl border-2 transition-all duration-300 text-right
                    {{ $category === 'gold' ? 'border-yellow-500 bg-yellow-500/10 shadow-lg shadow-yellow-500/20' : 'border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 hover:border-yellow-300' }}"
                >
                    <div class="relative z-10 flex flex-col gap-2">
                        <span class="text-2xl">🟡</span>
                        <span class="font-bold text-gray-900 dark:text-white">طلا</span>
                    </div>
                    <div class="absolute -bottom-2 -left-2 w-12 h-12 bg-yellow-500/10 rounded-full blur-xl group-hover:bg-yellow-500/20 transition-all"></div>
                </button>

                <!-- Currency -->
                <button 
                    wire:click="$set('category', 'currency')"
                    class="relative group overflow-hidden p-4 rounded-3xl border-2 transition-all duration-300 text-right
                    {{ $category === 'currency' ? 'border-green-500 bg-green-500/10 shadow-lg shadow-green-500/20' : 'border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 hover:border-green-300' }}"
                >
                    <div class="relative z-10 flex flex-col gap-2">
                        <span class="text-2xl">💵</span>
                        <span class="font-bold text-gray-900 dark:text-white">ارز</span>
                    </div>
                    <div class="absolute -bottom-2 -left-2 w-12 h-12 bg-green-500/10 rounded-full blur-xl group-hover:bg-green-500/20 transition-all"></div>
                </button>

                <!-- Crypto -->
                <button 
                    wire:click="$set('category', 'crypto')"
                    class="relative group overflow-hidden p-4 rounded-3xl border-2 transition-all duration-300 text-right
                    {{ $category === 'crypto' ? 'border-purple-500 bg-purple-500/10 shadow-lg shadow-purple-500/20' : 'border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 hover:border-purple-300' }}"
                >
                    <div class="relative z-10 flex flex-col gap-2">
                        <span class="text-2xl">🪙</span>
                        <span class="font-bold text-gray-900 dark:text-white">کریپتو</span>
                    </div>
                    <div class="absolute -bottom-2 -left-2 w-12 h-12 bg-purple-500/10 rounded-full blur-xl group-hover:bg-purple-500/20 transition-all"></div>
                </button>
            </div>
        </section>

        <!-- 🔵 Step 2: Item Selection -->
        <section class="space-y-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-yellow-500 text-white font-bold text-sm">۲</div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">انتخاب آیتم</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($items as $item)
                    <div 
                        wire:click="selectItem('{{ $item['symbol'] }}')"
                        class="group relative cursor-pointer p-5 rounded-3xl border-2 transition-all duration-300 
                        {{ $selectedSymbol === $item['symbol'] ? 'border-yellow-500 bg-yellow-50 dark:bg-yellow-900/20 shadow-md' : 'border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 hover:border-yellow-200 dark:hover:border-gray-700' }}"
                    >
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex flex-col">
                                <span class="text-xs font-medium text-gray-400 dark:text-gray-500 mb-1">{{ $item['symbol'] }}</span>
                                <span class="font-bold text-gray-900 dark:text-white text-lg">{{ $item['name'] }}</span>
                            </div>
                            <div class="px-2 py-1 rounded-lg text-xs font-bold
                                {{ ($item['change_percent'] ?? 0) >= 0 ? 'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400' }}">
                                {{ ($item['change_percent'] ?? 0) >= 0 ? '▲' : '▼' }} {{ number_format(abs($item['change_percent'] ?? 0), 2) }}%
                            </div>
                        </div>

                        <div class="flex items-baseline gap-1">
                            <span class="text-2xl font-black text-gray-900 dark:text-white">
                                {{ number_format($item['price']) }}
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">تومان</span>
                        </div>

                        @if($selectedSymbol === $item['symbol'])
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-yellow-500 text-white rounded-full flex items-center justify-center shadow-sm ring-4 ring-white dark:ring-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center bg-gray-50 dark:bg-gray-900/50 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-800">
                        <span class="text-gray-500 dark:text-gray-400">هیچ آیتمی در این دسته یافت نشد.</span>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- 🟡 Step 3: Purchase Calculation -->
        <section class="space-y-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-yellow-500 text-white font-bold text-sm">۳</div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">مقدار خرید</h3>
            </div>

            <div class="bg-white dark:bg-gray-900 p-8 rounded-3xl border border-gray-200 dark:border-gray-800 shadow-xl space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Amount Input -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-600 dark:text-gray-400 mr-1">مقدار مورد نظر</label>
                        <div class="relative">
                            <input 
                                type="text" 
                                wire:model.live.debounce.300ms="amount"
                                class="w-full px-4 py-4 rounded-2xl border-2 border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-yellow-500 focus:ring-0 transition-all outline-none text-lg font-semibold"
                                placeholder="مثلاً ۱۰"
                            />
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Unit Selection -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-600 dark:text-gray-400 mr-1">واحد محاسبه</label>
                        <div class="relative">
                            <select 
                                wire:model="unit"
                                class="w-full px-4 py-4 rounded-2xl border-2 border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-yellow-500 focus:ring-0 transition-all outline-none appearance-none text-lg font-semibold"
                            >
                                @foreach($this->availableUnits as $u)
                                    <option value="{{ $u }}">
                                        {{ $u === 'gram' ? 'گرم' : ($u === 'piece' ? 'عدد' : 'تومان') }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Price Summary -->
                <div class="p-6 rounded-2xl bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-800 space-y-4">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-400">قیمت هر واحد:</span>
                        <span class="font-bold text-gray-900 dark:text-white">{{ number_format($selectedPrice) }} تومان</span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                        <span class="text-lg font-bold text-gray-900 dark:text-white">جمع کل قابل پرداخت:</span>
                        <div class="text-2xl font-black text-yellow-600 dark:text-yellow-500">
                            {{ number_format($total) }} <span class="text-sm font-medium">تومان</span>
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <button 
                    wire:click="processPurchase"
                    wire:loading.attr="disabled"
                    class="w-full py-5 px-6 bg-yellow-500 hover:bg-yellow-600 disabled:bg-gray-400 text-white font-black text-xl rounded-2xl transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-yellow-500/30 flex items-center justify-center gap-3"
                >
                    <span wire:loading.remove>تکمیل و پرداخت سفارش</span>
                    <span wire:loading>در حال پردازش...</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>
            </div>
        </section>
    </div>
</div>
