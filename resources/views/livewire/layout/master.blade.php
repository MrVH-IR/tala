<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>گلدینا</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
        @yield('head')
    </head>
        <body class="font-sans antialiased">
            <!-- wrapper اصلی صفحه -->
        <div class="min-h-screen bg-gray-50 dark:bg-black text-black/50 dark:text-white/50">

            <!-- container کل محتوا -->
            <div class="relative w-full px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

            <!-- header -->
                <header class="grid items-center grid-cols-2 gap-4 py-10 lg:grid-cols-3">
                    @include('livewire.layout.header')
                    @yield('header')
                </header>

                <!-- main content -->
                <main class="mt-6 space-y-6">
                    {{ $slot }}
                </main>

                <!-- footer -->
                @include('livewire.layout.footer')
                @yield('footer')

            </div>
        </div>
    </body>
</html>
