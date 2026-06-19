<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component
{
    public string $message = '';
    public bool $show = false;

    #[On('app-notification')]
    public function notify($message)
    {
        $this->message = $message;
        $this->show = true;

        // Auto-hide after 5 seconds
        $this->dispatch('hide-notification');
    }

    public function hide()
    {
        $this->show = false;
    }
}; ?>

<div 
    x-data="{ 
        show: @entangle('show'),
        init() {
            this.$watch('show', value => {
                if (value) {
                    setTimeout(() => { this.show = false }, 5000);
                }
            })
        }
    }" 
    x-show="show" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-x-full"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 -translate-x-full"
    class="fixed top-5 left-5 z-[100] pointer-events-auto"
    style="display: none;"
>
    <div class="relative flex items-center gap-3 px-4 py-3 text-sm font-medium text-white shadow-2xl rounded-2xl bg-gradient-to-r from-pink-500 to-rose-500 border border-white/20 animate-bounce-subtle">
        <div class="flex items-center justify-center w-6 h-6 bg-white/20 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <span class="tracking-wide">{{ $message }}</span>
        <button @click="show = false" class="ml-2 p-1 transition-colors rounded-lg hover:bg-white/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

@push('styles')
<style>
    @keyframes bounce-subtle {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }
    .animate-bounce-subtle {
        animation: bounce-subtle 3s ease-in-out infinite;
    }
</style>
@endpush
