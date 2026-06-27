<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title' , "پنل ادمین")</title>
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>

    <body class="min-h-screen flex flex-col bg-slate-900">
        <header>
{{--            @include('admin.layouts.navbar')--}}
            @yield('header')
        </header>

        <main class="flex-1">
            @include('admin.layouts.sidebar')
            @yield('content')
        </main>
            @yield('footer')
        <livewire:components.notification />
        @include('admin.layouts.footer')
        @yield('script')
    </body>
</html>
