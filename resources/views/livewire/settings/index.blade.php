<x-app-layout>
    <div class="flex items-center justify-center min-h-[80vh]">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

            <!-- کارت انتخاب نام و موبایل -->
            <a href="{{ route('dashboard.setting.profile') }}"
                class="block p-8 text-center transition-all duration-300 bg-gray-900 shadow-lg group rounded-xl hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 hover:text-white hover:shadow-pink-500/30">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-12 h-12 mx-auto mb-4 text-gray-300 transition-transform duration-300 group-hover:text-white group-hover:scale-110"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z" />
                </svg>
                <h2 class="text-lg font-bold">نام و موبایل</h2>
                <p class="mt-2 text-gray-400 group-hover:text-white">تغییر نام و شماره همراه</p>
            </a>

            <!-- کارت انتخاب پسورد -->
            <a href="{{ route('dashboard.setting.password') }}"
                class="block p-8 text-center transition-all duration-300 bg-gray-900 shadow-lg group rounded-xl hover:bg-gradient-to-r hover:from-pink-500 hover:to-rose-500 hover:text-white hover:shadow-pink-500/30">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-12 h-12 mx-auto mb-4 text-gray-300 transition-transform duration-300 group-hover:text-white group-hover:scale-110"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 11c0 .727-.594 1.321-1.321 1.321H8v2.658a1.321 1.321 0 002.642 0v-2.658h2.658A1.321 1.321 0 0012 11zM12 3a9 9 0 100 18 9 9 0 000-18z" />
                </svg>
                <h2 class="text-lg font-bold">پسورد</h2>
                <p class="mt-2 text-gray-400 group-hover:text-white">تغییر رمز عبور</p>
            </a>

        </div>
    </div>
</x-app-layout>
