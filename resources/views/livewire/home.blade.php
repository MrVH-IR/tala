<div class="w-full px-4 mx-auto mt-6 sm:px-6 lg:px-8">
    @push('styles')
    <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('css/home/styles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/home/cards.css') }}">
        <link rel="stylesheet" href="{{ asset('css/home/animations.css') }}">
        <link rel="stylesheet" href="{{ asset('css/home/responsive.css') }}">
    @endpush
    <div class="mb-6 text-2xl text-center text-yellow-500">
        خرید طلای آب شده آنلاین با گلدینا
    </div>
        @include('livewire.layout.home.gold-piece')
    <div class="mx-auto mt-5 max-w-7xl">
        @include('livewire.layout.home.cards')
        @include('livewire.layout.home.calculate-gold')

            <!-- Gold Section -->
            <div class="cards-grid">
                @foreach ($gold as $item)
                    @include('livewire.layout.home.gold-card', ['item' => $item])
                @endforeach
                <!-- CURRENCY CARDS -->
                @foreach ($currency as $item)
                        @include('livewire.layout.home.currency-card', ['item' => $item])
                @endforeach
            </div>
    </div>
</div>
