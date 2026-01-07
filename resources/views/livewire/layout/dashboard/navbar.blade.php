<nav
    class="relative z-10 flex flex-wrap items-center justify-between px-6 py-4 font-sans bg-white shadow-xl dark:bg-gray-900 md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden md:w-64">
    <div
        class="flex flex-wrap items-center justify-between w-full px-0 mx-auto md:flex-col md:items-stretch md:min-h-full md:flex-nowrap">
        <a href="{{ route('home') }}">
            <img id="logo" class="max-w-[50px]" src="{{ asset('images/logos/nobg-g-logo.png') }}" alt="Goldina Logo" />
        </a>
        <div class="absolute top-0 left-0 right-0 z-40 items-center flex-1 hidden h-auto overflow-x-hidden overflow-y-auto rounded shadow md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none"
            id="example-collapse-sidebar">
            <div class="block pb-4 mb-4 border-b border-solid md:min-w-full md:hidden border-blueGray-200">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <a class="inline-block p-4 px-0 mr-0 text-sm font-bold text-left text-white uppercase md:block md:pb-2 text-blueGray-600 whitespace-nowrap"
                            href="../../index.html">
                            Goldina
                        </a>
                    </div>
                </div>
            </div>
            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />
            <!-- Navigation -->

            <ul class="flex flex-col list-none md:flex-col md:min-w-full">
                <li class="items-center">
                    <x-nav-link-a :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <!-- Dashboard icon -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 transition-all duration-300 text-slate-400 group-hover:text-white group-hover:scale-110"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z" />
                        </svg>

                        <span class="tracking-tight">
                            پنل کاربری
                        </span>
                    </x-nav-link-a>
                </li>

                <li x-data="{ open: false }" class="items-center">
                    <!-- لینک اصلی با دو عملکرد -->
                    <div class="flex items-center justify-between group">
                        <!-- متن کلیک برای رفتن به روت -->
                        <a href="{{ route('dashboard.setting') }}"
                            class="flex items-center flex-1 gap-3 px-4 py-3 text-sm font-medium transition-all duration-300 ease-out rounded-xl text-slate-300 hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 hover:text-white hover:shadow-lg hover:shadow-pink-500/30">
                            <!-- آیکون چرخ‌دنده -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 transition-all duration-300 group-hover:text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M11.983 2.25c-.727 0-1.321.594-1.321 1.321v.905a7.51 7.51 0 00-1.74.72l-.64-.64a1.321 1.321 0 00-1.868 0l-.707.707a1.321 1.321 0 000 1.868l.64.64a7.51 7.51 0 00-.72 1.74h-.905c-.727 0-1.321.594-1.321 1.321v1c0 .727.594 1.321 1.321 1.321h.905c.18.63.43 1.216.72 1.74l-.64.64a1.321 1.321 0 000 1.868l.707.707a1.321 1.321 0 001.868 0l.64-.64c.524.29 1.11.54 1.74.72v.905c0 .727.594 1.321 1.321 1.321h1c.727 0 1.321-.594 1.321-1.321v-.905a7.51 7.51 0 001.74-.72l.64.64a1.321 1.321 0 001.868 0l.707-.707a1.321 1.321 0 000-1.868l-.64-.64c.29-.524.54-1.11.72-1.74h.905c.727 0 1.321-.594 1.321-1.321v-1c0-.727-.594-1.321-1.321-1.321h-.905a7.51 7.51 0 00-.72-1.74l.64-.64a1.321 1.321 0 000-1.868l-.707-.707a1.321 1.321 0 00-1.868 0l-.64.64a7.51 7.51 0 00-1.74-.72v-.905c0-.727-.594-1.321-1.321-1.321h-1z" />
                            </svg>

                            <span>تنظیمات</span>
                        </a>

                        <!-- فلش کلیک برای باز/بسته کردن زیرمنو -->
                        <button @click="open = !open"
                            class="px-3 py-3 text-gray-400 transition-transform duration-300 hover:text-white"
                            :class="{ 'rotate-90': open }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>

                    <!-- زیرمنو -->
                    <ul x-show="open" x-transition class="pl-6 mt-2 space-y-1" @click.away="open = false">
                        <li>
                            <x-nav-link-a :href="route('dashboard.setting.profile')" :active="request()->routeIs('dashboard.setting.profile')"
                                class="block px-4 py-2 transition-all duration-300 ease-out text-slate-300 rounded-xl hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 hover:text-white hover:shadow-lg hover:shadow-pink-500/30">
                                نام و موبایل
                            </x-nav-link-a>
                        </li>
                        <li>
                            <x-nav-link-a :href="route('dashboard.setting.password')" :active="request()->routeIs('dashboard.setting.password')"
                                class="block px-4 py-2 transition-all duration-300 ease-out text-slate-300 rounded-xl hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 hover:text-white hover:shadow-lg hover:shadow-pink-500/30">
                                پسورد
                            </x-nav-link-a>
                        </li>
                    </ul>
                </li>


                <hr class="my-4 md:min-w-full" />
                <ul class="flex flex-col list-none md:flex-col md:min-w-full">
                    <li class="items-center">
                        <x-nav-link-a :href="route('dashboard.buy')" :active="request()->routeIs('dashboard.buy')">
                            <!-- icon -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 transition-all duration-300 text-slate-400 group-hover:text-white group-hover:scale-110"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M2.25 8.25h19.5m-19.5 0A2.25 2.25 0 004.5 6h15a2.25 2.25 0 012.25 2.25m-19.5 0v7.5A2.25 2.25 0 004.5 18h15a2.25 2.25 0 002.25-2.25v-7.5" />
                            </svg>

                            <span>خرید</span>
                        </x-nav-link-a>
                    </li>
                    <li class="items-center">
                        <x-nav-link-a :href="route('dashboard.sell')" :active="request()->routeIs('dashboard.sell')">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 text-slate-400 transition-all duration-300
                              group-hover:text-white group-hover:scale-110 group-hover:-translate-y-0.5"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M7 17L17 7m0 0H7m10 0v10" />
                            </svg>

                            <span>فروش</span>
                        </x-nav-link-a>
                    </li>
                </ul>

                <!-- Divider -->
                <hr class="my-4 md:min-w-full" />
                <!-- Navigation -->

                <li class="items-center">
                    <a href="{{ route('logout') }}"
                        class="relative flex items-center gap-3 px-4 py-3 text-sm font-medium transition-all duration-300 ease-out group rounded-xl text-slate-300 hover:bg-gradient-to-r hover:from-red-500 hover:to-rose-600 hover:text-white hover:shadow-lg hover:shadow-red-500/30">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 transition-all duration-300 text-slate-400 group-hover:text-white group-hover:translate-x-1"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H3" />
                        </svg>
                        <span>خروج</span>
                    </a>
                </li>
        </div>
    </div>
</nav>
