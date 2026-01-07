@props(['href', 'active' => false])

@php
    $baseClasses =
        'relative flex items-center gap-3 px-4 py-3 text-sm font-medium transition-all duration-300 ease-out group rounded-xl';

    $inactiveClasses =
        'text-slate-300 hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 hover:text-white hover:shadow-lg hover:shadow-pink-500/30';

    $activeClasses = 'bg-gradient-to-r from-pink-500 to-rose-500 text-white shadow-lg shadow-pink-500/30';
@endphp

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' => $baseClasses . ' ' . ($active ? $activeClasses : $inactiveClasses),
    ]) }}>
    {{ $slot }}
</a>
