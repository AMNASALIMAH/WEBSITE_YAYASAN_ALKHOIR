<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/icons/logo.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>YAYASAN AL-KHOIR</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        // Toggle ID bisa di-randomkan kalau kamu pakai di banyak tempat
    @endphp
    <script src="//unpkg.com/alpinejs" defer></script>

</head>

<body class="overflow-x-hidden flex flex-col min-h-screen ">
    <header class="fixed top-0 left-0 w-full z-50 bg-blue-950 shadow mb-6">
        @include('layouts.navbar')
    </header>

    <main class="flex-1 ">
        {{ $slot }}
    </main>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif

    {{-- Footer --}}
    
    <footer class="w-full bg-blue-950 text-white mt-20">
        @include('layouts.footer')
    </footer>


</body>

{{-- Script untuk toggle hamburger --}}
{{-- Script untuk toggle navbar --}}
{{-- Script Toggle Menu --}}
{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggle = document.getElementById("nav-toggle");
        const menu = document.getElementById("nav-menu");

        toggle.addEventListener("click", function() {
            menu.classList.toggle("hidden");
        });
    });
</script> --}}

</html>
