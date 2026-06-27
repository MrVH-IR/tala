<div class="mb-10">
    <div class="flex items-center justify-end gap-4 lg:gap-6">
        <nav class="flex items-center gap-3">
            @auth
                <a href="{{ url('/dashboard') }}" class="px-3 py-2 text-black transition rounded-md dark:text-white hover:text-black/70 dark:hover:text-white/80">
                    داشبورد
                </a>
                <a href="{{ url('logout') }}" class="px-3 py-2 text-black transition rounded-md dark:text-white hover:text-black/70 dark:hover:text-white/80">
                    خروج
                </a>
            @elseif(Auth::guard('admin')->check())
                <a href="{{ url('/admin/pages/home') }}" class="px-3 py-2 text-black transition rounded-md dark:text-white hover:text-black/70 dark:hover:text-white/80">
                    پنل ادمین
                </a>
                <a href="{{ url('admin/pages/logout') }}" class="px-3 py-2 text-black transition rounded-md dark:text-white hover:text-black/70 dark:hover:text-white/80">
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

        <div class="relative">
            <button
                id="themeToggleBtn"
                onclick="toggleThemeMenu()"
                class="p-2 transition rounded-full bg-gray-200 dark:bg-gray-800 hover:scale-105 text-xl"
                title="تم سایت"
            >
                🌗
            </button>

            <div id="themeMenu" class="hidden absolute left-0 mt-2 w-44 bg-white dark:bg-gray-900 shadow-lg rounded-lg overflow-hidden text-sm">
                <button onclick="setTheme('light')" class="block w-full px-4 py-2 text-right hover:bg-gray-100 dark:hover:bg-gray-800">
                    🌙 روشن
                </button>
                <button onclick="setTheme('dark')" class="block w-full px-4 py-2 text-right hover:bg-gray-100 dark:hover:bg-gray-800">
                    ☀️ تاریک
                </button>
                <button onclick="setTheme('system')" class="block w-full px-4 py-2 text-right hover:bg-gray-100 dark:hover:bg-gray-800">
                    🌗 سیستم
                </button>
            </div>
        </div>

    </div>
</div>
