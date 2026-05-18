<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? ($siteContent['meta']['title'] ?? 'Aanoukya Avenues | Architecture & Construction') }}</title>
        <meta name="description" content="{{ $siteContent['meta']['description'] ?? 'Aanoukya Avenues designs and builds premium residential and commercial spaces with precision, transparency, and timeless aesthetics.' }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="mesh-backdrop min-h-screen">
        @include('partials.site-header')

        <main>
            @yield('content')
        </main>

        @include('partials.site-footer')
    </body>
</html>
