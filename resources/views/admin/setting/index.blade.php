@extends('admin.layouts.app')

@section('content')

    <div class="space-y-6">

        {{-- Add Setting --}}
        <div class="rounded-2xl border border-gray-200 dark:border-slate-700
                bg-white dark:bg-slate-900 shadow">

            <div class="border-b border-gray-200 dark:border-slate-700 px-6 py-4">

                <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100">
                    مدیریت دسترسی صفحات
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    مسیرهایی که غیرفعال شوند برای کاربران با خطای 404 نمایش داده خواهند شد.
                </p>

            </div>

            <form action="{{ route('admin.setting.store') }}"
                  method="POST"
                  class="p-6 grid md:grid-cols-3 gap-5">

                @csrf

                {{-- Title --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        عنوان
                    </label>

                    <input
                        type="text"
                        name="title"
                        placeholder="مثال: صفحه خرید"
                        class="w-full rounded-lg border border-gray-300
                           dark:border-slate-700
                           bg-white dark:bg-slate-800
                           px-4 py-2
                           text-gray-800 dark:text-gray-200">

                </div>

                {{-- Route --}}
                <div>

                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        مسیر
                    </label>

                    <input
                        type="text"
                        name="route"
                        placeholder="/dashboard/buy"
                        class="w-full rounded-lg border border-gray-300
                           dark:border-slate-700
                           bg-white dark:bg-slate-800
                           px-4 py-2
                           text-gray-800 dark:text-gray-200">

                    <p class="text-xs text-gray-500 mt-2">

                        مسیر باید با "/" شروع شود.

                    </p>

                </div>

                {{-- Submit --}}
                <div class="flex items-end mb-6">

                    <button
                        class="w-full rounded-lg bg-blue-600
                           hover:bg-blue-700
                           py-2.5
                           text-white
                           font-medium">

                        ثبت مسیر

                    </button>

                </div>

            </form>

        </div>


        {{-- Table --}}
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
                            عنوان
                        </th>

                        <th class="px-6 py-4 text-left">
                            Route
                        </th>

                        <th class="px-6 py-4 text-center">
                            وضعیت
                        </th>

                        <th class="px-6 py-4 text-center">
                            عملیات
                        </th>

                    </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-slate-700">

                    @forelse($settings as $setting)

                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                            <td class="px-6 py-5 text-center font-semibold text-gray-500">

                                #{{ $setting->id }}

                            </td>

                            <td class="px-6 py-5">

                                <div class="font-medium text-gray-900 dark:text-gray-100">

                                    {{ $setting->title }}

                                </div>

                            </td>

                            <td class="px-6 py-5">

                                <code class="rounded bg-gray-100 dark:bg-slate-700
                                         px-3 py-1 text-sm text-sky-600 dark:text-sky-300">

                                    {{ $setting->route }}

                                </code>

                            </td>

                            <td class="px-6 py-5 text-center">

                                <form
                                    action="{{ route('admin.setting.update',$setting) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <input
                                        type="hidden"
                                        name="active"
                                        value="{{ $setting->active ? 0 : 1 }}">

                                    <button type="button"
                                        class="inline-flex items-center rounded-full px-4 py-1 text-xs font-semibold toggle-status
                                    {{ $setting->active
                                    ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300'
                                    : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300' }}"
                                        data-id="{{ $setting->id }}"
                                        data-active="{{ $setting->active ? 0 : 1 }}">

                                        {{ $setting->active ? 'فعال' : 'غیرفعال' }}

                                    </button>
                                </form>

                            </td>

                            <td class="px-6 py-5 text-center">

                                <form
                                    action="{{ route('admin.setting.destroy',$setting) }}"
                                    method="POST"
                                    onsubmit="return confirm('حذف شود؟')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="rounded-lg bg-red-600 hover:bg-red-700
                                           px-4 py-2 text-sm text-white">

                                        حذف

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="py-12 text-center text-gray-500">

                                هیچ مسیری ثبت نشده است.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="dark:text-gray-300">

            {{ $settings->links() }}

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
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const resultModal = document.getElementById('resultModal');
        const resultIcon = document.getElementById('resultIcon');
        const resultTitle = document.getElementById('resultTitle');
        const resultMessage = document.getElementById('resultMessage');
        const resultClose = document.getElementById('resultClose');

        function showResult(success, message) {

            resultIcon.className =
                `mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full ${
                    success
                        ? 'bg-green-100 text-green-600 dark:bg-green-500/20 dark:text-green-400'
                        : 'bg-red-100 text-red-600 dark:bg-red-500/20 dark:text-red-400'
                }`;

            resultIcon.innerHTML = success ? '✓' : '✕';
            resultTitle.textContent = success ? 'عملیات موفق' : 'خطا';
            resultMessage.textContent = message;

            resultModal.classList.remove('hidden');
        }

        resultClose.addEventListener('click', () => {
            resultModal.classList.add('hidden');
        });

        document.querySelectorAll('.toggle-status').forEach(button => {

            button.addEventListener('click', async () => {

                try {

                    const response = await fetch(`/admin/pages/setting/${button.dataset.id}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            active: Number(button.dataset.active)
                        })
                    });

                    const data = await response.json();

                    showResult(data.success, data.message);

                    if (data.success) {

                        button.dataset.active = button.dataset.active === '1' ? '0' : '1';

                        setTimeout(() => {
                            location.reload();
                        }, 1200);

                    }

                } catch (e) {

                    showResult(false, 'ارتباط با سرور برقرار نشد.');

                    console.error(e);

                }

            });

        });

    });
</script>
