<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | {{ config('app.name') }}</title>

    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">

<div class="flex min-h-screen items-center justify-center px-6">

    <div class="w-full max-w-lg">

        <div
            class="rounded-2xl border border-gray-200 bg-white shadow-sm
                   dark:border-gray-700 dark:bg-gray-800">

            <div class="p-10 text-center">

                {{-- Error Code --}}
                <div
                    class="text-7xl font-black tracking-tight
                           text-gray-300 dark:text-gray-600">

                    @yield('code')

                </div>

                {{-- Title --}}
                <h1
                    class="mt-5 text-2xl font-bold
                           text-gray-900 dark:text-white">

                    @yield('title')

                </h1>

                {{-- Message --}}
                <p
                    class="mt-3 leading-7
                           text-gray-600 dark:text-gray-400">

                    @yield('message')

                </p>

                {{-- Buttons --}}
                <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">

                    <a
                        href="{{ route('home') }}"
                        class="rounded-lg bg-gray-900 px-5 py-3 font-medium text-white transition hover:bg-gray-800
                               dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200">

                        صفحه اصلی

                    </a>

                    <button
                        onclick="history.back()"
                        class="rounded-lg border border-gray-300 px-5 py-3 font-medium transition
                               hover:bg-gray-100
                               dark:border-gray-600 dark:hover:bg-gray-700">

                        بازگشت

                    </button>

                </div>

            </div>

            <div
                class="border-t border-gray-200 px-6 py-4 text-center text-sm
                       text-gray-500 dark:border-gray-700 dark:text-gray-400">

                {{ config('app.name') }}

            </div>

        </div>

    </div>

</div>

</body>
</html>
