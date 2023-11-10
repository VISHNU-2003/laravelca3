<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Add any other head-related assets, styles, or scripts here -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 selection:bg-yellow-200 selection:text-black antialiased">
    @livewire('navigation-menu')
    
    <!-- Add any other body content, dynamic components, or Blade slots here -->
    {{ $slot }}
    
    @livewireScripts
    <!-- Add any other scripts or JavaScript libraries here -->
</body>
</html>
