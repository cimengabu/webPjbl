<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <x-back-button fallback="{{ route('home') }}" />
            <h2 class="font-black text-3xl text-white tracking-tight">
                {{ __('Edukasi Lingkungan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen text-white bg-[#050B14]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <article class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl">
                @if($article->image)
                    <div class="h-96 w-full overflow-hidden relative border-b border-white/10">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#050B14] to-transparent z-10"></div>
                        <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="p-10 space-y-6">
                    <div class="flex items-center gap-4">
                        <span class="text-[10px] uppercase font-black tracking-[0.2em] text-emerald-400 bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">
                            {{ $article->status }}
                        </span>
                        <span class="text-xs text-gray-500 font-mono">
                            Diterbitkan: {{ $article->created_at->format('d F Y') }}
                        </span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl font-black italic tracking-tighter text-white leading-tight">
                        {{ $article->title }}
                    </h1>

                    <div class="h-px bg-white/10 w-full"></div>

                    <div class="text-gray-300 text-lg leading-relaxed font-medium space-y-6">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    <div class="pt-8">
                        <x-back-button label="Kembali ke Beranda" fallback="{{ route('home') }}" />
                    </div>
                </div>
            </article>
        </div>
    </div>
</x-app-layout>
