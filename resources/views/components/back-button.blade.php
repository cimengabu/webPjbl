@props(['label' => 'Kembali', 'fallback' => null])

<button
    onclick="(function(){ if(window.history.length > 1){ window.history.back(); } else { window.location.href='{{ $fallback ?? url()->previous() }}'; } })()"
    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 hover:bg-white/20 text-white font-bold text-sm transition-all active:scale-95 border border-white/10 hover:border-white/30 group"
>
    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
    </svg>
    {{ $label }}
</button>
