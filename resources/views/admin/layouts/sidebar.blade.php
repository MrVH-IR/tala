<div x-data="{ open: true }" class="relative">

    <button
        @click="open = !open"
        class="fixed top-20 right-4 z-50 bg-white shadow-md rounded-lg p-3"
    >
        <i
            class="fa-solid"
            :class="open ? 'fa-xmark' : 'fa-bars'"
        ></i>
    </button>

    <aside
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 w-72 h-screen bg-white shadow-xl z-40"
    >
        <div class="p-6 border-b" style="background-color: #fad390">
            <h2 class="text-xl font-bold text-gray-800">
                پنل مدیریت
            </h2>
        </div>

        <nav class="p-4">
            <ul class="space-y-2">

                <li>
                    <a
                        href="{{ route('admin.home') }}"
                        class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100"
                    >
                        <i class="fa-solid fa-house"></i>
                        <span>داشبورد</span>
                    </a>
                </li>

                <li>
                    <a
                        href="{{ url('admin/pages/users') }}"
                        class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100"
                    >
                        <i class="fa-solid fa-users"></i>
                        <span>کاربران</span>
                    </a>
                </li>

                <li>
                    <a
                        href="#"
                        class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100"
                    >
                        <i class="fa-solid fa-coins"></i>
                        <span>دارایی‌ها</span>
                    </a>
                </li>

                <li>
                    <a
                        href="#"
                        class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100"
                    >
                        <i class="fa-solid fa-dollar"></i>
                        <span>درخواست های فروش دارایی</span>
                    </a>
                </li>

                <li>
                    <a
                        href="#"
                        class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100"
                    >
                        <i class="fa-solid fa-sack-dollar"></i>
                        <span>درخواست های خرید دارایی</span>
                    </a>
                </li>

                <li>
                    <a
                        href="#"
                        class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100"
                    >
                        <i class="fa-solid fa-gear"></i>
                        <span>تنظیمات</span>
                    </a>
                </li>

            </ul>
        </nav>

        <div class="absolute bottom-0 w-full border-t p-4">
            <form method="POST" action="{{ route('admin.auth.logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 text-red-600 hover:bg-red-50 p-3 rounded-lg"
                >
                    <i class="fa-solid fa-right-from-bracket"></i>
                    خروج
                </button>
            </form>
        </div>
    </aside>

    {{-- محتوای اصلی --}}
    <main
        class="transition-all duration-300"
        :class="open ? 'mr-72' : 'mr-0'"
    >
        <div class="p-6">

        </div>
    </main>

</div>
