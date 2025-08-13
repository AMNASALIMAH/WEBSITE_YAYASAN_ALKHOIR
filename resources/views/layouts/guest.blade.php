<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>YAYASAN AL-KHOIR</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-blue-950 antialiased bg-blue-950">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            {{-- Logo dan Nama Yayasan di Tengah --}}
            <div class="flex flex-col items-center justify-center mb-4">
                <img src="{{ asset('assets/images/logo3.png') }}" alt="Logo" class="h-24 w-auto " />
                <span class=" font-extrabold text-3xl tracking-wide uppercase text-blue-950">Yayasan Al Khoir</span>
            </div>

            {{-- Slot konten (form login, dll) --}}
            {{ $slot }}
        </div>
    </div>
</body>


</html>