<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Goldina') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vazirmatn@33.003/Vazirmatn-font-face.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-black text-gray-900 dark:text-white">
    <div class="flex min-h-screen">
        <!-- Sidebar / Navbar -->
        <livewire:layout.dashboard.navbar />

        <div class="flex-1 flex flex-col transition-all duration-300 md:mr-64">
            <!-- Top Header -->
            <header class="sticky top-0 z-30 flex items-center justify-between px-6 py-4 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-800">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                        {{ $header ?? 'داشبورد' }}
                    </h2>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-left hidden sm:block">
                        <p class="text-sm font-bold">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-yellow-500 flex items-center justify-center text-white font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6 space-y-6">
                {{ $slot }}
            </main>
        </div>
    </div>
    <livewire:components.notification />
    <script src="{{ asset('js/darkmode.js') }}"></script>
    @stack('scripts')
</body>

</html>
