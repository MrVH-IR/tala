@extends('admin.layouts.app')


@section('content')
    <div class="space-y-6">

        <div class="rounded-2xl overflow-hidden border
        border-gray-200 dark:border-slate-700
        bg-white dark:bg-slate-900 shadow">

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-100 dark:bg-slate-800">

                    <tr class="text-sm font-semibold text-gray-700 dark:text-gray-300">

                        <th class="px-6 py-4 text-center">
                            #
                        </th>

                        <th class="px-6 py-4 text-left">
                            کاربر
                        </th>

                        <th class="px-6 py-4 text-center">
                            دارایی
                        </th>

                        <th class="px-6 py-4 text-center">
                            نوع
                        </th>

                        <th class="px-6 py-4 text-center">
                            مقدار
                        </th>

                        <th class="px-6 py-4 text-center">
                            قیمت واحد
                        </th>

                        <th class="px-6 py-4 text-center">
                            مبلغ کل
                        </th>

                        <th class="px-6 py-4 text-center">
                            وضعیت
                        </th>

                        <th class="px-6 py-4 text-center">
                            تایید کننده
                        </th>

                        <th class="px-6 py-4 text-center">
                            ثبت شده
                        </th>

                    </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-slate-700">

                    @forelse($orders as $order)

                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                            {{-- ID --}}
                            <td class="px-6 py-5 text-center font-semibold text-gray-500">
                                #{{ $order->id }}
                            </td>

                            {{-- USER --}}
                            <td class="px-6 py-5">

                                <div class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $order->user->email }}
                                </div>

                            </td>

                            {{-- ASSET --}}
                            <td class="px-6 py-5 text-center">

                            <span class="inline-flex items-center rounded-full
                                bg-blue-100 text-blue-700
                                dark:bg-blue-900/40 dark:text-blue-300
                                px-3 py-1 text-xs font-semibold">

                                {{ $order->asset->symbol }}

                            </span>

                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $order->asset->name }}
                                </div>

                            </td>

                            {{-- TYPE --}}
                            <td class="px-6 py-5 text-center">

                                @if($order->type === 'BUY')

                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                    bg-green-100 text-green-700
                                    dark:bg-green-900/30 dark:text-green-300">

                                    خرید

                                </span>

                                @else

                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                    bg-red-100 text-red-700
                                    dark:bg-red-900/30 dark:text-red-300">

                                    فروش

                                </span>

                                @endif

                            </td>

                            {{-- AMOUNT --}}
                            <td class="px-6 py-5 text-center font-semibold text-green-600 dark:text-green-400">
                                {{ number_format($order->amount,8) }}
                            </td>

                            {{-- PRICE --}}
                            <td class="px-6 py-5 text-center text-violet-500 font-semibold">
                                {{ number_format($order->price,2) }}
                            </td>

                            {{-- TOTAL --}}
                            <td class="px-6 py-5 text-center font-semibold text-red-500">
                                {{ number_format($order->total_money,2) }}
                            </td>

                            {{-- STATUS --}}
                            <td class="px-6 py-5 text-center">

                                @php
                                    $colors = [
                                        'REQUESTED' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300',
                                        'PENDING' => 'bg-sky-100 text-sky-700 dark:bg-sky-900/30 dark:text-sky-300',
                                        'PAID' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                                        'COMPLETED' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                                        'REJECTED' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                        'CANCELLED' => 'bg-gray-200 text-gray-700 dark:bg-slate-700 dark:text-gray-300',
                                    ];
                                @endphp

                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $colors[$order->status->value] }}">
                                {{ $order->status->value }}
                            </span>

                            </td>

                            {{-- CONFIRMED BY --}}
                            <td class="px-6 py-5 text-center">

                                @if($order->confirmedBy)

                                    <div class="font-medium text-gray-800 dark:text-gray-200">
                                        {{ $order->confirmedBy->email }}
                                    </div>

                                @else

                                    <span class="text-gray-400">
                                    -
                                </span>

                                @endif

                            </td>

                            {{-- CREATED --}}
                            <td class="px-6 py-5 text-center text-sm text-gray-500">

                                {{ $order->created_at->format('Y-m-d') }}

                                <div class="text-xs text-gray-400">
                                    {{ $order->created_at->format('H:i') }}
                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="10"
                                class="py-12 text-center text-gray-500">

                                هیچ سفارشی یافت نشد.

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

    </div>
@endsection
