<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-black text-white tracking-tight">Buat Akun Baru</h2>
        <p class="text-emerald-400 font-medium mt-1">Bergabung dengan ekosistem EcoTrack</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-black uppercase text-gray-400 mb-2 tracking-widest">{{ __('Nama Lengkap') }}</label>
            <input id="name" class="block w-full bg-[#050B14] border border-white/10 rounded-2xl p-4 text-white focus:border-emerald-500 focus:ring focus:ring-emerald-500/20 outline-none transition-all" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-xs" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-black uppercase text-gray-400 mb-2 tracking-widest">{{ __('Email Address') }}</label>
            <input id="email" class="block w-full bg-[#050B14] border border-white/10 rounded-2xl p-4 text-white focus:border-emerald-500 focus:ring focus:ring-emerald-500/20 outline-none transition-all" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-black uppercase text-gray-400 mb-2 tracking-widest">{{ __('Password') }}</label>
            <input id="password" class="block w-full bg-[#050B14] border border-white/10 rounded-2xl p-4 text-white focus:border-emerald-500 focus:ring focus:ring-emerald-500/20 outline-none transition-all"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-black uppercase text-gray-400 mb-2 tracking-widest">{{ __('Konfirmasi Password') }}</label>
            <input id="password_confirmation" class="block w-full bg-[#050B14] border border-white/10 rounded-2xl p-4 text-white focus:border-emerald-500 focus:ring focus:ring-emerald-500/20 outline-none transition-all"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400 text-xs" />
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 text-black font-black py-4 rounded-2xl uppercase tracking-[0.2em] hover:from-emerald-400 hover:to-teal-500 transition-all shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] active:scale-95 text-sm flex items-center justify-center gap-2">
                {{ __('Daftar Sekarang') }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </button>
        </div>

        <div class="text-center mt-6">
            <p class="text-gray-500 text-sm">Sudah punya akun? <a href="{{ route('login') }}" class="text-emerald-400 font-bold hover:underline">Masuk di sini</a></p>
        </div>
    </form>
</x-guest-layout>
