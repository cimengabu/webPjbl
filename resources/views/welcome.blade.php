<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecotrack | AI Evolution</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background: #050a09; overflow-hidden; }
        
        /* Animasi Mesh Gradient untuk efek "Luar Biasa" */
        .mesh-gradient {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: #050a09;
            background-image: 
                radial-gradient(at 0% 0%, hsla(160,100%,15%,1) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(180,100%,10%,1) 0, transparent 50%),
                radial-gradient(at 100% 100%, hsla(150,100%,5%,1) 0, transparent 50%),
                radial-gradient(at 0% 100%, hsla(190,100%,15%,1) 0, transparent 50%);
            filter: blur(80px); z-index: -1; animation: mesh-move 20s infinite alternate;
        }

        @keyframes mesh-move {
            0% { transform: scale(1); }
            100% { transform: scale(1.2); }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .text-glow { text-shadow: 0 0 20px rgba(52, 211, 153, 0.5); }
    </style>
</head>
<body class="text-white">
    <div class="mesh-gradient"></div>

    <nav class="fixed top-0 w-full p-6 z-50 flex justify-between items-center">
        <div class="text-2xl font-bold tracking-tighter">ECO<span class="text-emerald-400">TRACK</span></div>
        <div class="hidden md:flex space-x-8 text-sm uppercase tracking-widest opacity-60">
            <a href="{{ route('ecotrack.index') }}" class="hover:opacity-100 transition">Sistem</a>
            <a href="#" class="hover:opacity-100 transition">AI Model</a>
            <a href="#" class="hover:opacity-100 transition">Changelog</a>
        </div>
    </nav>

    <main class="min-h-screen flex items-center justify-center p-6" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 500)">
        
        <div class="max-w-5xl w-full" x-show="loaded" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-y-12">
            
            <div class="flex justify-center mb-6">
                <span class="px-4 py-1 rounded-full border border-emerald-500/30 bg-emerald-500/10 text-emerald-400 text-xs tracking-widest uppercase animate-pulse">
                    System Update Live
                </span>
            </div>

            <div class="glass-card rounded-[3rem] p-8 md:p-16 relative overflow-hidden">
                <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&q=80&w=1000" 
                     class="absolute inset-0 w-full h-full object-cover opacity-10 mix-blend-overlay pointer-events-none" alt="Nature">

                <div class="relative z-10 text-center">
                    <h2 class="text-lg md:text-xl font-light mb-2 opacity-70">Welcome To "ecotrack.ecocell.tr"</h2>
                    
                    <div class="flex flex-col lg:flex-row items-center justify-center gap-6 my-8">
                        <h1 class="text-6xl md:text-9xl font-bold tracking-tighter leading-none">Updated To</h1>
                        <div class="relative">
                            <div class="absolute -inset-2 bg-emerald-500 rounded-2xl blur-xl opacity-40"></div>
                            <span class="relative bg-gradient-to-br from-emerald-400 to-cyan-500 text-black px-8 py-4 rounded-2xl text-6xl md:text-9xl font-black italic shadow-2xl block">
                                V2.25
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-center gap-6 mt-12 mb-8 group cursor-pointer">
                        <div class="w-16 h-16 md:w-24 md:h-24 bg-emerald-600 rounded-full flex items-center justify-center shadow-[0_0_40px_rgba(5,150,105,0.4)] group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-8 h-8 md:w-12 md:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                            </svg>
                        </div>
                        <h3 class="text-4xl md:text-7xl font-bold tracking-tight text-glow">Now Powered With AI</h3>
                    </div>

                    <div class="border-t border-white/10 pt-8 mt-12 grid md:grid-cols-2 gap-8 text-left">
                        <div>
                            <p class="text-emerald-400 text-xs uppercase tracking-widest mb-2 font-bold">Changelog Detail</p>
                            <p class="text-white/60 leading-relaxed italic">"qr code problem fixed, navigation bar added, real-time AI optimization, system improvements..."</p>
                        </div>
                        <div class="md:text-right flex flex-col justify-end">
                            <p class="text-white/40 text-[10px] uppercase tracking-[0.3em]">Operational Timestamp</p>
                            <p class="text-xl font-light">{{ now()->format('H:i:s') }} | <span class="opacity-50 text-sm">{{ now()->format('d M Y') }}</span></p>
                        </div>
                    </div>

                    <!-- CTA BUTTON TO DASHBOARD -->
                    <div class="mt-12 flex justify-center">
                        <a href="{{ route('ecotrack.index') }}" class="group relative inline-flex items-center justify-center gap-3 px-8 py-4 bg-emerald-500 text-black font-black text-xl rounded-full uppercase tracking-widest hover:bg-emerald-400 hover:scale-105 transition-all shadow-[0_0_30px_rgba(16,185,129,0.3)] hover:shadow-[0_0_50px_rgba(16,185,129,0.5)]">
                            Enter Dashboard
                            <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-between items-center px-6 opacity-40 text-[10px] tracking-[0.4em] uppercase">
                <span>Ecological Tracking System</span>
                <span>© 2026 Ecotrack Dev Team</span>
            </div>
        </div>
    </main>
</body>
</html>