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
                            موجودی
                        </th>

                        <th class="px-6 py-4 text-center">
                            موجودی قفل شده
                        </th>

                        <th class="px-6 py-4 text-center">
                            زمان ایجاد
                        </th>

                        <th class="px-6 py-4 text-center">
                            آخرین بروزرسانی
                        </th>

                    </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-slate-700">

                    @forelse($wallets as $wallet)

                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                            {{-- EMAIL --}}
                            <td class="px-6 py-5">

                                <div class="font-medium text-gray-900 dark:text-gray-100">

                                    {{ $wallet->user->email }}

                                </div>

                            </td>

                            {{-- ASSET --}}
                            <td class="px-6 py-5 text-center">

                            <span
                                class="inline-flex items-center rounded-full
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

                                    {{ number_format($wallet->balance, 6) }}

                                </div>

                            </td>

                            {{-- LOCKED --}}
                            <td class="px-6 py-5 text-center">

                                <div class="font-semibold text-red-500">

                                    {{ number_format($wallet->locked_balance, 6) }}

                                </div>

                            </td>

                            {{-- CREATED --}}
                            <td class="px-6 py-5 text-center text-sm text-gray-500">

                                {{ $wallet->created_at->format('Y-m-d') }}

                                <div class="text-xs text-gray-400">

                                    {{ $wallet->created_at->format('H:i') }}

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

                            <td colspan="6" class="py-12 text-center text-gray-500">

                                هیچ کیف پولی یافت نشد.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="dark:text-gray-300">

            {{ $wallets->links() }}

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
                            موجودی
                        </th>

                        <th class="px-6 py-4 text-center">
                            موجودی قفل شده
                        </th>

                        <th class="px-6 py-4 text-center">
                            زمان ایجاد
                        </th>

                        <th class="px-6 py-4 text-center">
                            آخرین بروزرسانی
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

        const response = await fetch(`/admin/pages/assets/search?query=${encodeURIComponent(query)}`);

        const wallets = await response.json();

        container.classList.add('hidden');
        searchContainer.classList.remove('hidden');

        searchBody.innerHTML = '';

        if (wallets.length === 0) {

            searchBody.innerHTML = `
            <tr>
                <td colspan="6" class="py-10 text-center text-gray-500">
                    نتیجه‌ای یافت نشد.
                </td>
            </tr>
        `;

            return;
        }

        wallets.forEach(wallet => {

            searchBody.innerHTML += `
            <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                <td class="px-6 py-5">
                    <div class="font-medium text-gray-900 dark:text-gray-100">
                        ${wallet.user.email}
                    </div>
                </td>

                <td class="px-6 py-5 text-center">

                    <span class="inline-flex items-center rounded-full
                        bg-blue-100 text-blue-700
                        dark:bg-blue-900/40 dark:text-blue-300
                        px-3 py-1 text-xs font-semibold">

                        ${wallet.asset.symbol}

                    </span>

                    <div class="text-xs text-gray-500 mt-1">
                        ${wallet.asset.name}
                    </div>

                </td>

                <td class="px-6 py-5 text-center">
                    <div class="font-semibold text-green-600 dark:text-green-400">
                        ${Number(wallet.balance).toFixed(6)}
                    </div>
                </td>

                <td class="px-6 py-5 text-center">
                    <div class="font-semibold text-red-500">
                        ${Number(wallet.locked_balance).toFixed(6)}
                    </div>
                </td>

                <td class="px-6 py-5 text-center text-sm text-gray-500">
                    ${wallet.created_at}
                </td>

                <td class="px-6 py-5 text-center text-sm text-gray-500">
                    ${wallet.updated_at}
                </td>

            </tr>
        `;

        });

    });
</script>
@endsection
