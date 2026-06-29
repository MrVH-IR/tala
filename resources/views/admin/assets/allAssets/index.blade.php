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

                        <th class="px-8 py-4 text-left">
                            کاربر
                        </th>

                        <th class="px-6 py-4 text-center">
                            دارایی
                        </th>

                        <th class="px-6 py-4 text-center">
                            موجودی
                        </th>

                        <th class="px-6 py-4 text-center">
                            موجودی قفل شده
                        </th>

                        <th class="px-6 py-4 text-center">
                            مجموع دارایی
                        </th>

                        <th class="px-6 py-4 text-center">
                            آخرین بروزرسانی
                        </th>

                    </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-slate-700">

                    @forelse($assets as $wallet)

                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                            {{-- ID --}}
                            <td class="px-6 py-5 text-center font-semibold text-gray-500">

                                #{{ $wallet->id }}

                            </td>

                            {{-- USER --}}
                            <td class="px-6 py-5">

                                <div class="font-medium text-gray-900 dark:text-gray-100">

                                    {{ $wallet->user->email }}

                                </div>

                            </td>

                            {{-- ASSET --}}
                            <td class="px-6 py-5 text-center">

                            <span class="inline-flex items-center rounded-full
                                bg-blue-100 text-blue-700
                                dark:bg-blue-900/40 dark:text-blue-300
                                px-3 py-1 text-xs font-semibold">

                                {{ $wallet->asset->symbol }}

                            </span>

                                <div class="text-xs text-gray-500 mt-1">

                                    {{ $wallet->asset->name }}

                                </div>

                            </td>

                            {{-- BALANCE --}}
                            <td class="px-6 py-5 text-center">

                                <div class="font-semibold text-green-600 dark:text-green-400">

                                    {{ number_format($wallet->balance, 8) }}

                                </div>

                            </td>

                            {{-- LOCKED --}}
                            <td class="px-6 py-5 text-center">

                                <div class="font-semibold text-red-500">

                                    {{ number_format($wallet->locked_balance, 8) }}

                                </div>

                            </td>

                            {{-- TOTAL --}}
                            <td class="px-6 py-5 text-center">

                                <div class="font-semibold text-violet-500">

                                    {{ number_format($wallet->balance + $wallet->locked_balance, 8) }}

                                </div>

                            </td>

                            {{-- UPDATED --}}
                            <td class="px-6 py-5 text-center text-sm text-gray-500">

                                {{ $wallet->updated_at->format('Y-m-d') }}

                                <div class="text-xs text-gray-400">

                                    {{ $wallet->updated_at->format('H:i') }}

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="py-12 text-center text-gray-500">

                                هیچ کیف پولی یافت نشد.

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

@endsection
