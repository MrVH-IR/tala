<div class="flex items-center justify-end gap-4 py-6 pr-6">

    <!-- لینک‌ها -->
    <nav class="flex items-center gap-3">
        @auth
            <a href="{{ url('/dashboard') }}" class="px-3 py-2 text-black transition rounded-md dark:text-white hover:text-black/70 dark:hover:text-white/80">
                داشبورد
            </a>
        @else
            <a href="{{ route('login') }}" class="px-3 py-2 text-black transition rounded-md dark:text-white hover:text-black/70 dark:hover:text-white/80">
                ورود
            </a>
            @if(Route::has('register'))
                <a href="{{ route('register') }}" class="px-3 py-2 text-black transition rounded-md dark:text-white hover:text-black/70 dark:hover:text-white/80">
                    ثبت نام
                </a>
            @endif
        @endauth
    </nav>

    <!-- لوگو -->
    <div>
        <img id="logo" class="max-w-[50px]" src="{{ asset('images/logos/logo-goldina.png') }}" alt="Goldina Logo"/>
    </div>

</div>
