@extends('admin.layouts.app')

@section('content')
    <div class="space-y-6" id="container">

        <div class="rounded-2xl overflow-hidden border
                border-gray-200 dark:border-slate-700
                bg-white dark:bg-slate-900 shadow ml-5 mr-5">

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-100 dark:bg-slate-800">

                    <tr class="text-sm font-semibold text-gray-700 dark:text-gray-300">

                        <th class="px-8 py-4 text-left">
                            نام کاربر
                        </th>

                        <th class="px-6 py-4 text-center">
                            ایمیل کاربر
                        </th>

                        <th class="px-6 py-4 text-center">
                            موضوع
                        </th>

                        <th class="px-6 py-4 text-center">
                            پیغام
                        </th>

                    </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-slate-700">

                    @forelse($messages as $message)

                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                            {{-- NAME --}}
                            <td class="px-6 py-5">

                                <div class="font-medium text-gray-900 dark:text-gray-100">

                                    {{ $message->name }}

                                </div>

                            </td>

                            {{-- EMAIL --}}
                            <td class="px-6 py-5 text-center">

                            <span
                                class="inline-flex items-center rounded-full
                                bg-blue-100 text-blue-700
                                dark:bg-blue-900/40 dark:text-blue-300
                                px-3 py-1 text-xs font-semibold">

                                {{ $message->email }}

                            </span>

                                <div class="text-xs text-gray-500 mt-1">

                                    {{ $message->created_at }}

                                </div>

                            </td>

                            {{-- SUBJECT --}}
                            <td class="px-6 py-5 text-center">

                                <div class="font-semibold text-red-600 dark:text-red-400">

                                    {{ $message->subject  }}

                                </div>

                            </td>

                            {{-- MESSAGE --}}
                            <td class="px-6 py-5 text-center">

                                <button
                                    type="button"
                                    onclick='openMessageModal(@json($message->message))'
                                    class="text-green-600 hover:text-green-500 text-right max-w-xs"
                                >
                                    {{ \Illuminate\Support\Str::limit($message->message, 60) }}
                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="py-12 text-center text-gray-500">

                                هیچ پیغامی دریافت نشد

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="dark:text-gray-300">

            {{ $messages->links() }}

        </div>

        <div id="messageModal"
             class="fixed inset-0 hidden items-center justify-center bg-black/50 backdrop-blur-sm z-50">

            <div class="w-full max-w-2xl mx-4 bg-white dark:bg-slate-900 rounded-2xl shadow-xl">

                <div class="flex items-center justify-between p-5 border-b border-gray-200 dark:border-slate-700">

                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                        متن کامل پیام
                    </h2>

                    <button
                        onclick="closeMessageModal()"
                        class="text-gray-500 hover:text-red-500 text-2xl"
                    >
                        ×
                    </button>

                </div>

                <div class="p-6">

                    <p id="messageContent"
                       class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap break-words leading-7 text-right">
                    </p>

                </div>

            </div>

        </div>
@endsection
        @section('script')
            <script>

                const messageModal = document.getElementById('messageModal');
                const messageContent = document.getElementById('messageContent');

                function openMessageModal(message)
                {
                    messageContent.textContent = message;

                    messageModal.classList.remove('hidden');
                    messageModal.classList.add('flex');
                }

                function closeMessageModal()
                {
                    messageModal.classList.add('hidden');
                    messageModal.classList.remove('flex');
                }

                messageModal.addEventListener('click', function (e) {

                    if (e.target === messageModal) {
                        closeMessageModal();
                    }

                });

            </script>
@endsection
