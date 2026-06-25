@extends('admin.layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-6" dir="rtl">
        <div class="bg-white rounded-xl shadow-lg flex flex-col lg:flex-row overflow-hidden max-w-4xl w-full">

            <img
                src="{{ asset('images/admin/login_wallpaper.jpeg') }}"
                alt="Admin Login"
                class="w-full lg:w-96 h-64 lg:h-auto object-cover"
            />

            <div class="flex-1 p-6 lg:p-10">
                <h1 class="text-2xl font-bold mb-8 text-gray-800">
                    ورود به پنل مدیریت
                </h1>

                <form method="POST" action="{{ route('admin.auth.login') }}">
                    @csrf

                    <div class="mb-5">
                        <label
                            for="email"
                            class="flex items-center gap-2 mb-2 text-sm font-medium text-gray-700"
                        >
                            <i class="fa-solid fa-envelope text-gray-500"></i>
                            <span>ایمیل</span>
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            placeholder="admin@goldina.com"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        >
                    </div>

                    <div class="mb-6">
                        <label
                            for="password"
                            class="flex items-center gap-2 mb-2 text-sm font-medium text-gray-700"
                        >
                            <i class="fa-solid fa-lock text-gray-500"></i>
                            <span>رمز عبور</span>
                        </label>

                        <input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="********"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        >
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-3 rounded-lg transition"
                    >
                        ورود
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection
