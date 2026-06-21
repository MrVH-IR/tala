@props([
    'message',
    'type' => 'success'
])

<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 5000)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed top-5 left-5 z-[9999]"
    style="display:none;"
>
    <div
        @class([
            'flex items-center gap-3 px-5 py-4 rounded-2xl shadow-2xl text-white min-w-[300px]',
            'bg-green-600' => $type === 'success',
            'bg-red-600' => $type === 'error',
            'bg-yellow-500' => $type === 'warning',
            'bg-blue-600' => $type === 'info',
        ])
    >
        <span>{{ $message }}</span>

        <button
            @click="show = false"
            class="ml-auto"
        >
            ✕
        </button>
    </div>
</div>
