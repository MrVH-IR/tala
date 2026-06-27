<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full dark" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('code') | {{ config('app.name') }}</title>

    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">

<div class="flex min-h-screen items-center justify-center px-6">

    <div class="text-center">

        <div
            class="text-6xl font-extrabold tracking-tight
                   text-gray-300 dark:text-gray-600">

            @yield('code')

        </div>

        <p
            class="mt-4 text-lg
                   text-gray-700 dark:text-gray-300">

            @yield('message')

        </p>

        <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">

            <a
                href="{{ url('/') }}"
                class="bg-red-600 text-white hover:bg-red-700 dark:bg-red-600 dark:hover:bg-red-700 rounded-lg">
                صفحه اصلی
            </a>

            <button
                onclick="history.back()"
                class="rounded-lg border border-gray-300 px-5 py-2.5 transition
                       hover:bg-gray-100
                       dark:border-gray-700 dark:hover:bg-gray-800">

                بازگشت

            </button>

        </div>

    </div>

</div>

</body>
</html>
