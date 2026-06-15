<nav class="relative z-30 flex flex-col w-64 h-screen bg-white dark:bg-gray-900 border-l border-gray-200 dark:border-gray-800 transition-all duration-300 overflow-y-auto md:fixed md:top-0 md:bottom-0 md:right-0">
    <!-- Logo Section -->
    <div class="flex items-center justify-center py-8 border-b border-gray-100 dark:border-gray-800">
        <a href="{{ route('home') }}" class="transition-transform duration-300 hover:scale-110">
            <img id="logo" class="w-12" src="{{ asset('images/logos/nobg-g-logo.png') }}" alt="Goldina Logo" />
        </a>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 px-4 py-6 space-y-8">
        <div>
            <p class="px-4 mb-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">منوی اصلی</p>
            <ul class="space-y-2">
                <li>
                    <x-nav-link-a :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-yellow-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>داشبورد</span>
                    </x-nav-link-a>
                </li>
                <li>
                    <x-nav-link-a :href="route('dashboard.buy')" :active="request()->routeIs('dashboard.buy')" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-yellow-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>خرید طلا</span>
                    </x-nav-link-a>
                </li>
                <li>
                    <x-nav-link-a :href="route('dashboard.sell')" :active="request()->routeIs('dashboard.sell')" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-yellow-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16V4m0 0L3 8m4-4l4 4m-4-4v12" />
                        </svg>
                        <span>فروش طلا</span>
                    </x-nav-link-a>
                </li>
            </ul>
        </div>

        <div>
            <p class="px-4 mb-4 text-[10px] font-bold text-gray-400 uppercase tracking-wider">تنظیمات</p>
            <ul class="space-y-2">
                <li>
                    <x-nav-link-a :href="route('dashboard.setting.profile')" :active="request()->routeIs('dashboard.setting.profile')" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-yellow-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>پروفایل</span>
                    </x-nav-link-a>
                </li>
                <li>
                    <x-nav-link-a :href="route('dashboard.setting.password')" :active="request()->routeIs('dashboard.setting.password')" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-yellow-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v-2H4a1 1 0 01-1-1v-4a1 1 0 011-1h3" />
                        </svg>
                        <span>رمز عبور</span>
                    </x-nav-link-a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Logout Section -->
    <div class="p-4 border-t border-gray-100 dark:border-gray-800">
        <a href="{{ route('logout') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-red-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span>خروج از حساب</span>
        </a>
    </div>
</nav>
