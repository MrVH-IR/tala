<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'گلدینا') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-white bg-gray-50 dark:bg-black">
        <div class="flex flex-col items-center justify-center min-h-screen p-6 relative overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-yellow-500/10 blur-3xl rounded-full -z-10"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-blue-500/10 blur-3xl rounded-full -z-10"></div>

            <div class="mb-8 transform transition-transform hover:scale-105 duration-300">
                <a href="/" wire:navigate>
                    <x-application-logo class="w-20 h-20 text-yellow-500 fill-current" />
                </a>
            </div>

            <div class="w-full max-w-md p-8 bg-white dark:bg-gray-900 shadow-2xl rounded-3xl border border-gray-200 dark:border-gray-800 transition-all">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
