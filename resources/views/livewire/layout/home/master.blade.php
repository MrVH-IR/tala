<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title' , "گلدینا")</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
        @yield('head')
    </head>
        <body class="font-sans antialiased">
            <!-- wrapper اصلی صفحه -->
        <div class="min-h-screen bg-gray-50 dark:bg-black text-black/50 dark:text-white/50">
            <div class="relative w-full px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

            <!-- header -->
                <header class="flex items-center justify-between py-10">
                    @include('livewire.layout.home.header')
                    @yield('header')
                </header>

                <!-- main content -->
                <main class="mt-6 space-y-6">
                    {{ $slot }}
                </main>

                <!-- footer -->
                @include('livewire.layout.home.footer')
                @yield('footer')

            </div>
        </div>
    </body>
</html>
