@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6">

        <div class="rounded-2xl overflow-hidden border
            border-gray-200 dark:border-slate-700
            bg-white dark:bg-slate-900 shadow">

            <div class="p-4">

                <input
                    id="searchInput"
                    type="text"
                    placeholder="Search..."
                    class="w-full rounded-lg border border-gray-300 dark:border-slate-700
                       bg-white dark:bg-slate-800 px-4 py-2
                       text-gray-800 dark:text-gray-200">

            </div>

        </div>

    </div>
    <div class="space-y-6" id="container">

        <div class="rounded-2xl overflow-hidden border
                border-gray-200 dark:border-slate-700
                bg-white dark:bg-slate-900 shadow">

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-100 dark:bg-slate-800">

                    <tr class="text-sm font-semibold text-gray-700 dark:text-gray-300">

                        <th class="px-8 py-4 text-left">
                            ایمیل کاربر
                        </th>

                        <th class="px-6 py-4 text-center">
                            دارایی
                        </th>

                        <th class="px-6 py-4 text-center">
                            مقدار درخواستی برای فروش
                        </th>

                        <th class="px-6 py-4 text-center">
                            قیمت محاسبه شده
                        </th>

                        <th class="px-6 py-4 text-center">
                            مبلغ دریافتی کاربر
                        </th>

                        <th class="px-6 py-4 text-center">
                            زمان ثبت درخواست
                        </th>

                        <th class="px-6 py-4 text-center">
                            عملیات
                        </th>

                    </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-slate-700">

                    @forelse($assets as $asset)

                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                            {{-- EMAIL --}}
                            <td class="px-6 py-5">

                                <div class="font-medium text-gray-900 dark:text-gray-100">

                                    {{ $asset->user->email }}

                                </div>

                            </td>

                            {{-- ASSET --}}
                            <td class="px-6 py-5 text-center">

                            <span
                                class="inline-flex items-center rounded-full
                                bg-blue-100 text-blue-700
                                dark:bg-blue-900/40 dark:text-blue-300
                                px-3 py-1 text-xs font-semibold">

                                {{ $asset->asset->symbol }}

                            </span>

                                <div class="text-xs text-gray-500 mt-1">

                                    {{ $asset->asset->name }}

                                </div>

                            </td>

                            {{-- AMOUNT --}}
                            <td class="px-6 py-5 text-center">

                                <div class="font-semibold text-green-600 dark:text-green-400">

                                    {{ number_format($asset->amount, 8) }}

                                </div>

                            </td>

                            {{-- PRICE --}}
                            <td class="px-6 py-5 text-center">

                                <div class="font-semibold text-violet-500">

                                    {{ number_format($asset->price, 8) }}

                                </div>

                            </td>

                            {{-- TOTAL MONEY --}}
                            <td class="px-6 py-5 text-center">

                                <div class="font-semibold text-red-500">

                                    {{ number_format($asset->total_money, 8) }}

                                </div>

                            </td>

                            {{-- UPDATED --}}
                            <td class="px-6 py-5 text-center text-sm text-gray-500">

                                {{ $asset->created_at->format('Y-m-d') }}

                                <div class="text-xs text-gray-400">

                                    {{ $asset->created_at->format('H:i') }}

                                </div>

                            </td>

                            @php
                                $options = ['REQUESTED', 'PENDING', 'REJECTED', 'CANCELLED', 'PAID', 'COMPLETED'];
                            @endphp

                            {{-- OPERATION --}}
                            <td class="px-6 py-5 text-center text-sm text-sky-400">
                                <select
                                    class="operation bg-gray-600"
                                    data-id="{{ $asset->id }}"
                                >
                                    @foreach($options as $option)
                                        <option value="{{ $option }}" @if($asset->status->value === $option) selected @endif>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="py-12 text-center text-gray-500">

                                هیچ درخواست فروش یافت نشد.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="dark:text-gray-300">

            {{ $assets->links() }}

        </div>

    </div>

    <div id="modal"
         class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center">
        <div class="w-full max-w-md rounded-2xl bg-white dark:bg-slate-800 shadow-2xl">
            <div class="border-b border-gray-200 dark:border-slate-700 p-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-500/20">

                        ⚠️

                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900 dark:text-white">
                            تغییر وضعیت سفارش
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            آیا از انجام این عملیات مطمئن هستید؟
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 p-5">
                <button id="no"
                        class="rounded-lg border border-gray-300 dark:border-slate-600 px-5 py-2 hover:bg-gray-100 dark:hover:bg-slate-700">

                    انصراف

                </button>
                <button id="yes"
                        class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

                    تایید

                </button>
            </div>
        </div>
    </div>

    <div id="resultModal"
         class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center">
        <div class="w-full max-w-sm rounded-2xl bg-white dark:bg-slate-800 shadow-2xl p-7 text-center">
            <div id="resultIcon"
                 class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full">

            </div>
            <h3 id="resultTitle"
                class="text-xl font-bold mb-2">
            </h3>
            <p id="resultMessage"
               class="text-gray-500 dark:text-gray-300">
            </p>
            <button id="resultClose"
                    class="mt-6 w-full rounded-lg bg-blue-600 py-3 text-white hover:bg-blue-700">

                متوجه شدم

            </button>
        </div>
    </div>

    <div id="searchContainer" class="space-y-6 hidden">

        <div class="rounded-2xl overflow-hidden border
        border-gray-200 dark:border-slate-700
        bg-white dark:bg-slate-900 shadow">

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-100 dark:bg-slate-800">

                    <tr class="text-sm font-semibold text-gray-700 dark:text-gray-300">

                        <th class="px-8 py-4 text-left">
                            ایمیل کاربر
                        </th>

                        <th class="px-6 py-4 text-center">
                            دارایی
                        </th>

                        <th class="px-6 py-4 text-center">
                            مقدار درخواستی برای فروش
                        </th>

                        <th class="px-6 py-4 text-center">
                            قیمت محاسبه شده
                        </th>

                        <th class="px-6 py-4 text-center">
                            مبلغ دریافتی کاربر
                        </th>

                        <th class="px-6 py-4 text-center">
                            زمان ثبت درخواست
                        </th>

                        <th class="px-6 py-4 text-center">
                            عملیات
                        </th>
                    </tr>
                    </thead>

                    <tbody id="searchBody"></tbody>

                </table>

            </div>

        </div>

    </div>

@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const modal = document.getElementById('modal');
        const yes = document.getElementById('yes');
        const no = document.getElementById('no');

        const resultModal = document.getElementById('resultModal');
        const resultIcon = document.getElementById('resultIcon');
        const resultTitle = document.getElementById('resultTitle');
        const resultMessage = document.getElementById('resultMessage');
        const resultClose = document.getElementById('resultClose');

        let currentSelect = null;
        let previousValue = null;

        /**
         * Result Modal
         */
        function showResult(success, message) {

            resultIcon.className =
                `mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full ${
                    success
                        ? 'bg-green-100 text-green-600 dark:bg-green-500/20 dark:text-green-400'
                        : 'bg-red-100 text-red-600 dark:bg-red-500/20 dark:text-red-400'
                }`;

            resultIcon.textContent = success ? '✓' : '✕';
            resultTitle.textContent = success ? 'عملیات موفق' : 'خطا';
            resultMessage.textContent = message;

            resultModal.classList.remove('hidden');
        }

        resultClose.addEventListener('click', () => {
            resultModal.classList.add('hidden');
        });

        /**
         * Select Changed
         */
        document.querySelectorAll('.operation').forEach(select => {

            select.addEventListener('focus', () => {
                select.dataset.current = select.value;
            });

            select.addEventListener('change', () => {

                currentSelect = select;
                previousValue = select.dataset.current;

                modal.classList.remove('hidden');

            });

        });

        /**
         * Cancel
         */
        no.addEventListener('click', () => {

            modal.classList.add('hidden');

            if (currentSelect) {
                currentSelect.value = previousValue;
            }

        });

        /**
         * Confirm
         */
        yes.addEventListener('click', async () => {

            modal.classList.add('hidden');

            try {

                const response = await fetch(
                    `/admin/pages/assets/sell/${currentSelect.dataset.id}`,
                    {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            status: currentSelect.value
                        })
                    }
                );

                const data = await response.json();
                console.log('success =', data.success);
                console.log('typeof =', typeof data.success);
                console.log(data);
                if (data.success === true) {

                    currentSelect.dataset.current = currentSelect.value;

                    showResult(true, data.message);

                } else {

                    currentSelect.value = previousValue;

                    showResult(false, data.message);

                }

            } catch (e) {

                currentSelect.value = previousValue;

                showResult(false, 'ارتباط با سرور برقرار نشد.');

            }

        });

    });

    const input = document.getElementById('searchInput');

    const container = document.getElementById('container');

    const searchContainer = document.getElementById('searchContainer');

    const searchBody = document.getElementById('searchBody');

    input.addEventListener('keyup', async function () {

        const query = this.value.trim();

        if (query === '') {

            container.classList.remove('hidden');
            searchContainer.classList.add('hidden');
            searchBody.innerHTML = '';

            return;
        }

        const response = await fetch(`/admin/pages/assets/sell/search?query=${encodeURIComponent(query)}`);

        const assets = await response.json();

        container.classList.add('hidden');
        searchContainer.classList.remove('hidden');

        searchBody.innerHTML = '';

        if (assets.length === 0) {

            searchBody.innerHTML = `
            <tr>
                <td colspan="6" class="py-10 text-center text-gray-500">
                    نتیجه‌ای یافت نشد.
                </td>
            </tr>
        `;

            return;
        }

        assets.forEach(assets => {

            searchBody.innerHTML += `
            <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                <td class="px-6 py-5">
                    <div class="font-medium text-gray-900 dark:text-gray-100">
                        ${assets.user.email}
                    </div>
                </td>

                <td class="px-6 py-5 text-center">

                    <span class="inline-flex items-center rounded-full
                        bg-blue-100 text-blue-700
                        dark:bg-blue-900/40 dark:text-blue-300
                        px-3 py-1 text-xs font-semibold">

                        ${assets.asset.symbol}

                    </span>

                    <div class="text-xs text-gray-500 mt-1">
                        ${assets.asset.name}
                    </div>

                </td>

                <td class="px-6 py-5 text-center">
                    <div class="font-semibold text-green-600 dark:text-green-400">
                        ${Number(assets.amount).toFixed(6)}
                    </div>
                </td>

                <td class="px-6 py-5 text-center">
                    <div class="font-semibold text-red-500">
                        ${Number(assets.price).toFixed(6)}
                    </div>
                </td>

                <td class="px-6 py-5 text-center text-sm text-gray-500">
                    ${assets.total_money}
                </td>

                <td class="px-6 py-5 text-center text-sm text-gray-500">
                    ${assets.created_at}
                </td>

                <td class="px-6 py-5 text-center text-sm text-gray-500">
                    ${assets.status}
                </td>

            </tr>
        `;

        });

    });
</script>
@endsection
