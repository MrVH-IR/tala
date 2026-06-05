<div class="py-6">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">

            {{-- Title --}}
            <div class="flex justify-center mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white text-center">
                    انتخاب نوع دارایی
                </h3>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-center">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

                    <button
                        wire:click="$set('category', 'gold')"
                        class="border rounded-lg p-3 text-yellow-300 hover:bg-gray-100 dark:hover:bg-gray-700
                {{ $category === 'gold' ? 'border-blue-500' : '' }}"
                    >
                        🟡 طلا
                    </button>

                    <button
                        wire:click="$set('category', 'currency')"
                        class="border rounded-lg p-3 text-green-500 hover:bg-gray-100 dark:hover:bg-gray-700
                {{ $category === 'currency' ? 'border-blue-500' : '' }}"
                    >
                        💵 ارز
                    </button>

                    <button
                        wire:click="$set('category', 'crypto')"
                        class="border rounded-lg p-3 text-purple-500 hover:bg-gray-100 dark:hover:bg-gray-700
                {{ $category === 'crypto' ? 'border-blue-500' : '' }}"
                    >
                        🪙 کریپتو
                    </button>

                </div>
            </div>

        </div>

        {{-- 🔹 لیست آیتم‌ها --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">

            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                انتخاب آیتم
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                @forelse($items as $item)

                    <div
                        wire:click="selectItem(@js($item['symbol']))"
                        class="cursor-pointer rounded-xl border p-4 transition
                        hover:shadow-md hover:border-blue-500
                        {{ $selectedSymbol === $item['symbol'] ? 'border-blue-500 bg-gray-50 dark:bg-gray-700' : '' }}"
                                    >

                        {{-- Header --}}
                        <div class="flex justify-between items-center">
                            <div class="font-bold text-gray-900 dark:text-white">
                                {{ $item['name'] }}
                            </div>

                            <div class="text-xs px-2 py-1 rounded
                                {{ ($item['change_percent'] ?? 0) >= 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ number_format($item['change_percent'] ?? 0, 2) }}%
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="mt-3 text-sm text-gray-600 dark:text-gray-300">
                            قیمت:
                            <span class="font-bold text-gray-900 dark:text-white">
                                {{ number_format($item['price']) }}
                            </span>
                            تومان
                        </div>

                        {{-- Symbol --}}
                        <div class="mt-1 text-xs text-gray-400">
                            {{ $item['symbol'] }}
                        </div>

                    </div>

                @empty
                    <div class="text-gray-500">
                        آیتمی موجود نیست
                    </div>
                @endforelse

            </div>
        </div>

        {{-- 🔹 خرید --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm space-y-4">

            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                مقدار خرید
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- مقدار --}}
                <div>
                    <label class="text-sm text-gray-600">مقدار</label>

                    <input
                        type="text"
                        wire:model.live.debounce.300ms="amount"
                        class="form-input w-full"
                        placeholder="مثلاً 10"
                    />
                </div>

                {{-- واحد --}}
                <div>
                    <label class="text-sm text-gray-600">واحد</label>

                    <select
                        wire:model="unit"
                        class="form-input w-full"
                    >
                        <option value="gram">گرم</option>
                        <option value="piece">عدد</option>
                        <option value="toman">تومان</option>
                    </select>
                </div>

            </div>

            {{-- 💡 قیمت واحد --}}
            <div class="text-sm text-gray-600">
                قیمت واحد انتخاب‌شده:
                <strong class="text-gray-900">
                    {{ number_format($selectedPrice) }}
                </strong>
                تومان
            </div>

            {{-- 💰 جمع کل --}}
            <div class="text-lg font-bold text-right text-gray-900 border-t pt-3">
                جمع کل:
                {{ number_format($total) }} تومان
            </div>

            {{-- دکمه --}}
            <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
                ادامه خرید
            </button>

        </div>

    </div>
</div>
