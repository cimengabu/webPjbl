<nav x-data="{ open: false }" class="bg-[#050B14]/80 backdrop-blur-xl border-b border-white/10 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-xl flex items-center justify-center shadow-[0_0_15px_rgba(16,185,129,0.4)]">
                    <svg class="w-6 h-6 text-[#050B14]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                </div>
                <a href="{{ route('home') }}" class="text-2xl font-black text-white tracking-tight hover:text-emerald-400 transition-colors">
                    EcoTrack
                </a>
            </div>

            <!-- Menu kanan -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">
            
                <a href="{{ route('recycling-centers.index') }}"
                   class="flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-emerald-400 hover:bg-emerald-500/10 hover:border-emerald-500/30 transition-all font-medium text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Peta Bank Sampah
                </a>

                <div class="h-6 w-px bg-white/10 mx-2"></div>

                @auth
                    <div class="flex items-center gap-4">
                        <span class="text-gray-400 font-medium text-sm">
                            Halo, <span class="text-white">{{ explode(' ', Auth::user()->name)[0] }}</span>
                        </span>

                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-white/5 border border-white/10 text-emerald-400 hover:bg-emerald-500 hover:text-[#050B14] hover:shadow-[0_0_15px_rgba(16,185,129,0.4)] hover:scale-105 transition-all" title="Profil Pengguna">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit"
                                class="flex items-center justify-center w-10 h-10 rounded-full bg-white/5 border border-white/10 text-red-400 hover:bg-red-500 hover:text-white hover:shadow-[0_0_15px_rgba(239,68,68,0.4)] hover:scale-105 transition-all" title="Logout">
                                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}"
                           class="text-gray-300 hover:text-white font-medium transition-colors text-sm">
                            Masuk
                        </a>

                        <a href="{{ route('register') }}"
                           class="bg-gradient-to-r from-emerald-400 to-teal-500 text-[#050B14] hover:from-emerald-300 hover:to-teal-400 font-black px-5 py-2 rounded-full shadow-[0_0_15px_rgba(16,185,129,0.3)] hover:shadow-[0_0_20px_rgba(16,185,129,0.5)] transition-all transform hover:-translate-y-0.5 text-sm">
                            Daftar Sekarang
                        </a>
                    </div>
                @endauth

            </div>

        </div>
    </div>
</nav>