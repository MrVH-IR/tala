<div
    x-data="{ show: @entangle('show') }"
    x-show="show"
    x-transition
    x-init="setTimeout(() => show = false, 5000)"
    class="fixed top-5 left-5 z-[9999]"
>
    <div
        @class([
            "flex items-center gap-3 px-5 py-4 rounded-2xl shadow-xl text-white min-w-[320px]",

            "bg-green-600" => ($notification['type'] ?? '') === 'success',
            "bg-red-600"   => ($notification['type'] ?? '') === 'error',
            "bg-yellow-500"=> ($notification['type'] ?? '') === 'warning',
            "bg-blue-600"  => ($notification['type'] ?? '') === 'info',
        ])
    >
        {{-- Icon --}}
        <div class="w-5 h-5">
            @if(($notification['type'] ?? '') === 'success')
                ✔
            @elseif(($notification['type'] ?? '') === 'error')
                ✖
            @elseif(($notification['type'] ?? '') === 'warning')
                !
            @else
                i
            @endif
        </div>

        {{-- Message --}}
        <div class="text-sm font-medium">
            {{ $notification['message'] ?? '' }}
        </div>

        {{-- Close --}}
        <button class="ml-auto opacity-70 hover:opacity-100" @click="show = false">
            ✕
        </button>
    </div>
</div>
