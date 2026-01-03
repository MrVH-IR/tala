<div class="w-full px-4 mx-auto mt-6 sm:px-6 lg:px-8">
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('css/gold-piece.css') }}">
    @endpush
    <!-- عنوان -->
    <div class="mb-6 text-2xl text-center text-yellow-500">
        خرید طلای آب شده آنلاین با گلدینا
    </div>
    <div class="relative w-full max-w-xl mx-auto mb-8 overflow-hidden shadow-lg rounded-2xl">
        @include('livewire.layout.gold-piece')
    </div>
    <div class="mx-auto mt-5 max-w-7xl">
        <!-- Cards Container -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

            <!-- Card 1: Security/Protection -->
            <div class="relative p-8 transition-all duration-500 border group bg-gradient-to-br from-gray-800/60 to-gray-900/60 backdrop-blur-xl rounded-2xl border-yellow-500/20 hover:border-yellow-500/50 hover:scale-105 hover:shadow-2xl hover:shadow-yellow-500/20">
                <!-- Icon Container -->
                <div class="flex justify-center mb-6">
                    <div class="flex items-center justify-center w-24 h-24 transition-all duration-500 rounded-full shadow-lg bg-gradient-to-br from-yellow-400 to-yellow-600 shadow-yellow-500/50 group-hover:shadow-yellow-500/80 group-hover:rotate-12">
                        <svg class="w-12 h-12 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L4 7v5.5c0 5.3 3.8 10.3 9 11.5 5.2-1.2 9-6.2 9-11.5V7l-8-5zm0 10.5l-4-2.5 1-1.5 3 1.8 5-5.8 1.5 1.5-6.5 7z"/>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h3 class="mb-4 text-2xl font-bold text-center text-yellow-400 transition-colors duration-300 group-hover:text-yellow-300">
                    امنیت
                </h3>

                <!-- Description -->
                <p class="leading-relaxed text-center text-gray-300">
                    حفاظت کامل از سرمایه شما با بالاترین استانداردهای امنیتی
                </p>
            </div>

            <!-- Card 2: Speed/Fast -->
            <div class="relative p-8 transition-all duration-500 border group bg-gradient-to-br from-gray-800/60 to-gray-900/60 backdrop-blur-xl rounded-2xl border-yellow-500/20 hover:border-yellow-500/50 hover:scale-105 hover:shadow-2xl hover:shadow-yellow-500/20">
                <!-- Icon Container -->
                <div class="flex justify-center mb-6">
                    <div class="flex items-center justify-center w-24 h-24 transition-all duration-500 rounded-full shadow-lg bg-gradient-to-br from-yellow-400 to-yellow-600 shadow-yellow-500/50 group-hover:shadow-yellow-500/80 group-hover:rotate-12">
                        <svg class="w-12 h-12 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z"/>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h3 class="mb-4 text-2xl font-bold text-center text-yellow-400 transition-colors duration-300 group-hover:text-yellow-300">
                    سرعت
                </h3>

                <!-- Description -->
                <p class="leading-relaxed text-center text-gray-300">
                    پردازش فوری تراکنش‌ها و دریافت سریع طلای شما
                </p>
            </div>

            <!-- Card 3: Reliability -->
            <div class="relative p-8 transition-all duration-500 border group bg-gradient-to-br from-gray-800/60 to-gray-900/60 backdrop-blur-xl rounded-2xl border-yellow-500/20 hover:border-yellow-500/50 hover:scale-105 hover:shadow-2xl hover:shadow-yellow-500/20">
                <!-- Icon Container -->
                <div class="flex justify-center mb-6">
                    <div class="flex items-center justify-center w-24 h-24 transition-all duration-500 rounded-full shadow-lg bg-gradient-to-br from-yellow-400 to-yellow-600 shadow-yellow-500/50 group-hover:shadow-yellow-500/80 group-hover:rotate-12">
                        <svg class="w-12 h-12 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                            <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h3 class="mb-4 text-2xl font-bold text-center text-yellow-400 transition-colors duration-300 group-hover:text-yellow-300">
                    اعتماد
                </h3>

                <!-- Description -->
                <p class="leading-relaxed text-center text-gray-300">
                    قابل اعتماد و شفاف در تمام مراحل معامله
                </p>
            </div>

            <div class="relative col-span-5 p-8 transition-all duration-500 border group bg-gradient-to-br from-gray-800/60 to-gray-900/60 backdrop-blur-xl rounded-2xl border-yellow-500/20 hover:border-yellow-500/50 hover:scale-105 hover:shadow-2xl hover:shadow-yellow-500/20">

                <!-- Inputs Wrapper -->
                <div class="flex flex-col items-center justify-center gap-6">

                    <!-- Input 1 -->
                    <div class="w-full max-w-sm">
                        <label class="block mb-2 text-sm font-medium text-yellow-400">
                            هزینه طلا (به تومان)
                        </label>
                        <input
                            type="text"
                            placeholder="مثلاً 25,000,000"
                            class="w-full px-4 py-3 text-center text-yellow-300 transition-all bg-transparent border border-yellow-500/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-400 placeholder:text-gray-400"
                        >
                    </div>

                    <!-- Input 2 -->
                    <div class="w-full max-w-sm">
                        <label class="block mb-2 text-sm font-medium text-yellow-400">
                            وزن طلا (میلی گرم)
                        </label>
                        <input
                            type="text"
                            placeholder="مثلاً 10.5"
                            class="w-full px-4 py-3 text-center text-yellow-300 transition-all bg-transparent border border-yellow-500/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500/50 focus:border-yellow-400 placeholder:text-gray-400"
                        >
                    </div>

                </div>
            </div>

            <div class="grid justify-center grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($gold as $item)
                    <div class="relative flex flex-col h-full p-6 transition-all duration-500 border group
                                bg-gradient-to-br from-gray-800/60 to-gray-900/60 backdrop-blur-xl
                                rounded-2xl border-yellow-500/20 hover:border-yellow-500/50
                                hover:scale-105 hover:shadow-2xl hover:shadow-yellow-500/20
                                w-full max-w-[280px]">
                        @include('livewire.layout.gold-card', ['item' => $item])
                    </div>
                @endforeach

                @foreach ($currency as $item)
                    <div class="relative flex flex-col h-full p-6 transition-all duration-500 border group
                                bg-gradient-to-br from-gray-800/60 to-gray-900/60 backdrop-blur-xl
                                rounded-2xl border-green-500/20 hover:border-green-500/50
                                hover:scale-105 hover:shadow-2xl hover:shadow-green-500/20
                                w-full max-w-[280px]">
                        @include('livewire.layout.currency-card', ['item' => $item])
                    </div>
                @endforeach
            </div>



        </div>
    </div>
</div>
