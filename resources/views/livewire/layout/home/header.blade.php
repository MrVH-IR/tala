<div>
    <div class="flex items-center justify-end gap-4 lg:gap-6">
        <nav class="flex items-center gap-3">
            @auth
                <a href="{{ url('/dashboard') }}" class="px-3 py-2 text-black transition rounded-md dark:text-white hover:text-black/70 dark:hover:text-white/80">
                    داشبورد
                </a>
                <a href="{{ url('logout') }}" class="px-3 py-2 text-black transition rounded-md dark:text-white hover:text-black/70 dark:hover:text-white/80">
                    خروج
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

        <div>
            <a href="#">
            <img id="logo" class="max-w-[50px]" src="{{ asset('images/logos/nobg-g-logo.png') }}" alt="Goldina Logo"/>
            </a>
        </div>
    </div>
</div>
