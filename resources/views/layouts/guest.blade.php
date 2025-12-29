<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $siteName = $siteSettings['site_name'] ?? 'VgenTech';
        $defaultDescription =
            $siteSettings['site_description'] ?? 'Cung cấp máy phát điện Cummins, Doosan, VMAN chính hãng, giá tốt';
        $defaultKeywords = $siteSettings['site_keywords'] ?? 'máy phát điện, cummins, doosan, vman';
    @endphp
    <title>@yield('title', $siteName)</title>
    <meta name="description" content="@yield('description', $defaultDescription)">
    <meta name="keywords" content="@yield('keywords', $defaultKeywords)">

    @if (!empty($siteSettings['site_favicon_url']))
        <link rel="icon" href="{{ $siteSettings['site_favicon_url'] }}" type="image/x-icon">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a class="d-flex align-items-center justify-content-center mb-4" href="/" style="text-decoration: none;">
                @php
                    $hasLogo = !empty($siteSettings['site_logo_url']);
                @endphp
                @if ($hasLogo)
                    <img src="{{ $siteSettings['site_logo_url'] }}" alt="{{ $siteName }}" style="height: 60px; width: auto;">
                @else
                    <span class="fw-bold text-primary" style="font-size: 1.5rem;">{{ $siteName }}</span>
                @endif
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
