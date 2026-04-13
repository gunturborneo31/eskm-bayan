<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0f766e">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="E-SKM Bayan">
    <meta name="description" content="Dashboard survei kepuasan masyarakat yang lebih rapi, responsif, dan siap dipasang sebagai PWA.">
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/logo-bayan.png') }}">
    <link rel="icon" href="{{ asset('assets/logo-bayan.png') }}">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    @hasSection('content')
        @yield('content')
    @else
        {{ $slot ?? '' }}
    @endif
    @livewireScripts
</body>
</html>



