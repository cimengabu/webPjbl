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
        <div class="min-h-screen relative z-10 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/" class="text-4xl font-black text-white tracking-tight hover:text-emerald-400 transition-colors flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-xl flex items-center justify-center shadow-[0_0_15px_rgba(16,185,129,0.4)]">
                        <svg class="w-7 h-7 text-[#050B14]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                    </div>
                    EcoTrack
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white/5 backdrop-blur-xl shadow-2xl border border-white/10 overflow-hidden sm:rounded-[2rem]">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
