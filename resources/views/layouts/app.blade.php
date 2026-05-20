<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @php
            $defaultTitle = $siteContent['meta']['title'] ?? 'Aanoukya Avenues | Architecture & Construction';
            $defaultDescription = $siteContent['meta']['description'] ?? 'Aanoukya Avenues designs and builds premium residential and commercial spaces with precision, transparency, and timeless aesthetics.';
            $siteName = $siteContent['meta']['site_name'] ?? 'Aanoukya Avenues';

            $metaTitle = trim($__env->yieldContent('meta_title', $title ?? $defaultTitle));
            $metaDescription = trim($__env->yieldContent('meta_description', $defaultDescription));
            $canonicalUrl = $__env->yieldContent('canonical_url', url()->current());
            $metaImage = $__env->yieldContent('meta_image', asset('images/logo.avif'));
            $twitterCard = trim($__env->yieldContent('twitter_card', 'summary_large_image'));

            $structuredData = [
                '@context' => 'https://schema.org',
                '@type' => 'LocalBusiness',
                'name' => $siteName,
                'url' => config('app.url'),
                'logo' => asset('images/logo.avif'),
                'telephone' => $siteContent['footer']['studio_phone'] ?? '+91 98765 43210',
                'email' => $siteContent['footer']['studio_email'] ?? 'hello@aanoukyaavenues.com',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => $siteContent['footer']['studio_city'] ?? 'Bengaluru, Karnataka',
                    'addressCountry' => 'IN',
                ],
            ];
        @endphp

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="view-transition" content="same-origin">

        <title>{{ $metaTitle }}</title>
        <meta name="description" content="{{ $metaDescription }}">
        <link rel="canonical" href="{{ $canonicalUrl }}">

        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ $siteName }}">
        <meta property="og:title" content="{{ $metaTitle }}">
        <meta property="og:description" content="{{ $metaDescription }}">
        <meta property="og:url" content="{{ $canonicalUrl }}">
        <meta property="og:image" content="{{ $metaImage }}">

        <meta name="twitter:card" content="{{ $twitterCard }}">
        <meta name="twitter:title" content="{{ $metaTitle }}">
        <meta name="twitter:description" content="{{ $metaDescription }}">
        <meta name="twitter:image" content="{{ $metaImage }}">

        <script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

        @yield('head')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="mesh-backdrop min-h-screen page-transition-body">
        @include('partials.site-header')

        <main>
            @yield('content')
        </main>

        @include('partials.site-footer')
    </body>
</html>
