<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-white/5 border border-white/10 text-gray-300 font-bold rounded-2xl uppercase tracking-widest text-xs hover:bg-white/10 hover:text-white transition-all active:scale-95 outline-none']) }}>
    {{ $slot }}
</button>

