<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $meta_description ?? 'Free Games for You!' }}">
    <meta name="keywords" content="{{ $meta_keyword ?? 'free games, ps1, ps2, windows games, popular games' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ $title ?? 'Tomss14 - Free Games for You!' }}
    </title>
    <link rel="icon" href="{{ asset('fav-icon-new.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-slate-200 m-4">
    @livewire('partials.navbar')    
    @livewire('partials.background')
    <main>
        
        {{ $slot }}
        
    </main>
    @livewire('partials.footer')
    @stack('scripts')
    @livewireScripts
</body>
</html>
