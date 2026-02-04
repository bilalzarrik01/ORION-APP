<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=archivo:300,400,500,600|playfair+display:500,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="veil">
            <div class="container">
                <header class="flex flex-col items-center justify-between gap-3 py-7 text-sm uppercase tracking-[0.2em] sm:flex-row sm:gap-6">
                    <a class="brand" href="/">
                        <img class="brand-logo" src="{{ asset('images/logo.png') }}" alt="Odin logo">
                        Orion
                    </a>
                    <nav class="flex flex-wrap items-center gap-3 text-xs tracking-[0.08em]">
                        <a class="text-muted hover:text-white" href="{{ url('/') }}">Home</a>
                        @if (Route::has('login'))
                            @auth
                                <a class="nav-btn" href="{{ url('/dashboard') }}">Dashboard</a>
                            @else
                                <a class="nav-btn" href="{{ route('login') }}">Login</a>
                                @if (Route::has('register'))
                                    <a class="nav-btn primary" href="{{ route('register') }}">Sign Up</a>
                                @endif
                            @endauth
                        @endif
                    </nav>
                </header>

                {{ $slot }}
            </div>
        </div>
    </body>
</html>
