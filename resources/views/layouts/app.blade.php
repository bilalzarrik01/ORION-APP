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
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="pt-10">
                        {{ $header }}
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="pb-16">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
