<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EcoTrack') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Animasi Mesh Gradient untuk latar belakang global */
            .mesh-gradient-bg {
                position: fixed; 
                top: -50%; left: -50%; 
                width: 200%; height: 200%;
                background-color: #050B14;
                background-image: 
                    radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.1) 0, transparent 40%), 
                    radial-gradient(circle at 80% 20%, rgba(6, 182, 212, 0.08) 0, transparent 30%),
                    radial-gradient(circle at 20% 80%, rgba(20, 184, 166, 0.08) 0, transparent 30%),
                    radial-gradient(circle at 80% 80%, rgba(59, 130, 246, 0.08) 0, transparent 30%);
                z-index: -1; 
                animation: mesh-move 20s infinite alternate;
            }

            @keyframes mesh-move {
                0% { transform: scale(1) translate(0, 0); }
                100% { transform: scale(1.1) translate(-2%, -2%); }
            }
        </style>
    </head>
    <body class="font-sans antialiased text-white selection:bg-emerald-500 selection:text-white bg-[#050B14]">
        <div class="mesh-gradient-bg"></div>
        <div class="min-h-screen relative z-10 flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading (Hidden internally or styled dark if used) -->
            @isset($header)
                <header class="bg-white/5 border-b border-white/10 backdrop-blur-md">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>