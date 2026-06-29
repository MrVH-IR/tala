@extends('admin.layouts.app')


@section('content')
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
                            دارایی درخواستی
                        </th>

                        <th class="px-6 py-4 text-center">
                            مقدار درخواستی
                        </th>

                        <th class="px-6 py-4 text-center">
                            قیمت دارایی
                        </th>

                        <th class="px-6 py-4 text-center">
                            مبلغ پرداختی
                        </th>

                        <th class="px-6 py-4 text-center">
                            زمان درخواست
                        </th>

                        <th class="px-6 py-4 text-center">
                            عملیات
                        </th>

                    </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-slate-700">

                    @forelse($orders as $order)

                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                            {{-- EMAIL --}}
                            <td class="px-6 py-5">

                                <div class="font-medium text-gray-900 dark:text-gray-100">

                                    {{ $order->user->email}}

                                </div>

                            </td>

                            {{-- ASSET --}}
                            <td class="px-6 py-5 text-center">

                            <span
                                class="inline-flex items-center rounded-full
                                bg-blue-100 text-blue-700
                                dark:bg-blue-900/40 dark:text-blue-300
                                px-3 py-1 text-xs font-semibold">

                                {{ $order->asset->name }}

                            </span>

                                <div class="text-xs text-gray-500 mt-1">

                                    {{ $order->asset->symbol }}

                                </div>

                            </td>

                            {{-- AMOUNT --}}
                            <td class="px-6 py-5 text-center">

                                <div class="font-semibold text-green-600 dark:text-green-400">

                                    {{ number_format($order->amount, 18) }}

                                </div>

                            </td>

                            {{-- PRICE --}}
                            <td class="px-6 py-5 text-center">

                                <div class="font-semibold text-orange-300">

                                    {{ number_format($order->price, 18) }}

                                </div>

                            </td>

                            {{-- TOTAL MONEY --}}
                            <td class="px-6 py-5 text-center">

                                <div class="font-semibold text-violet-400">

                                    {{ number_format($order->total_money, 18) }}

                                </div>

                            </td>

                            {{-- TIMESTAMP --}}
                            <td class="px-6 py-5 text-center text-sm text-red-500">

                                {{ $order->created_at->format('Y-m-d') }}

                                <div class="text-xs text-gray-400">

                                    {{ $order->created_at->format('H:i') }}

                                </div>

                            </td>

                            @php
                             $options = ['REQUESTED', 'PENDING', 'REJECTED', 'CANCELLED', 'PAID', 'COMPLETED'];
                            @endphp

                            {{-- OPERATION --}}
                                <td class="px-6 py-5 text-center text-sm text-sky-400">
                                    <select
                                        class="operation bg-gray-600"
                                        data-id="{{ $order->id }}"
                                    >
                                        @foreach($options as $option)
                                            <option value="{{ $option }}" @if($order->status->name === $option) selected @endif>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </td>
                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="py-12 text-center text-gray-500">

                                هیچ درخواستی یافت نشد.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="dark:text-gray-300">

            {{ $orders->links() }}

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
@endsection
@section('script')
    <script>
        const modal = document.getElementById('modal');
        const yes = document.getElementById('yes');
        const no = document.getElementById('no');

        let selectedOrderId = null;
        let selectedStatus = null;
        let currentSelect = null;

        const url = "{{ url('/admin/pages/assets/request/buy') }}";

        document.querySelectorAll('.operation').forEach(select => {

            select.addEventListener('change', function () {

                selectedOrderId = this.dataset.id;
                selectedStatus = this.value;
                currentSelect = this;

                modal.classList.remove('hidden');
            });

        });

        no.addEventListener('click', () => {

            modal.classList.add('hidden');

            currentSelect.selectedIndex = 0;

        });

        yes.addEventListener('click', async () => {

            modal.classList.add('hidden');

            const response = await fetch(`${url}/${selectedOrderId}`, {

                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                body: JSON.stringify({
                    status: selectedStatus
                })

            });

            const result = await response.json();

            function showResult(success, message) {

                const modal = document.getElementById('resultModal');
                const icon = document.getElementById('resultIcon');
                const title = document.getElementById('resultTitle');
                const text = document.getElementById('resultMessage');
                const resultClose = document.getElementById('resultClose');

                text.textContent = message;

                if (success) {

                    icon.className =
                        "mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-green-600";

                    icon.innerHTML = "✓";

                    title.textContent = "عملیات موفق";

                } else {

                    icon.className =
                        "mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-red-100 text-red-600";

                    icon.innerHTML = "✕";

                    title.textContent = "خطا";

                }

                modal.classList.remove('hidden');

                resultClose.addEventListener('click', () => {
                    modal.classList.add('hidden');
                    window.location.reload();
                });
            }

            showResult(result.success , result.message);
        });
    </script>
@endsection
