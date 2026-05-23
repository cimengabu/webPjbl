<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-3xl font-black text-white tracking-tight">Selamat Datang Kembali</h2>
        <p class="text-emerald-400 font-medium mt-1">Masuk untuk melanjutkan ke EcoTrack</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-black uppercase text-gray-400 mb-2 tracking-widest">{{ __('Email Address') }}</label>
            <input id="email" class="block w-full bg-[#050B14] border border-white/10 rounded-2xl p-4 text-white focus:border-emerald-500 focus:ring focus:ring-emerald-500/20 outline-none transition-all" type="email" name="email" :value="old('email')" required autofocus autocomplete="off" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-black uppercase text-gray-400 mb-2 tracking-widest">{{ __('Password') }}</label>
            <div class="relative">
                <input id="password" class="block w-full bg-[#050B14] border border-white/10 rounded-2xl p-4 pr-12 text-white focus:border-emerald-500 focus:ring focus:ring-emerald-500/20 outline-none transition-all"
                                type="password"
                                name="password"
                                required autocomplete="new-password" placeholder="••••••••" />
                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-white transition-colors focus:outline-none">
                    <svg id="eye-icon-open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg id="eye-icon-closed" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 015.458-5.943m4.945-1.91A10.05 10.05 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.05 10.05 0 01-1.394 3.736m-1.742 2.37A6.978 6.978 0 0112 15a3 3 0 01-3-3m5.32 5.32l-10.64-10.64" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-white/20 bg-[#050B14] text-emerald-500 shadow-sm focus:ring-emerald-500/20 w-5 h-5 cursor-pointer" name="remember">
                <span class="ms-3 text-sm text-gray-400 group-hover:text-gray-300 transition-colors">{{ __('Ingat Saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-bold text-emerald-500 hover:text-emerald-400 transition-colors" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 text-black font-black py-4 rounded-2xl uppercase tracking-[0.2em] hover:from-emerald-400 hover:to-teal-500 transition-all shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] active:scale-95 text-sm flex items-center justify-center gap-2">
                {{ __('Masuk Ke Sistem') }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </button>
        </div>
        
        <div class="text-center mt-6">
            <p class="text-gray-500 text-sm">Belum punya akun? <a href="{{ route('register') }}" class="text-emerald-400 font-bold hover:underline">Daftar sekarang</a></p>
        </div>
    </form>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIconOpen = document.getElementById('eye-icon-open');
            const eyeIconClosed = document.getElementById('eye-icon-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIconOpen.classList.add('hidden');
                eyeIconClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIconOpen.classList.remove('hidden');
                eyeIconClosed.classList.add('hidden');
            }
        }
    </script>
</x-guest-layout>
