<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-black font-black rounded-2xl uppercase tracking-widest text-xs hover:from-emerald-400 hover:to-teal-500 transition-all shadow-[0_0_15px_rgba(16,185,129,0.2)] hover:shadow-[0_0_25px_rgba(16,185,129,0.4)] active:scale-95 outline-none']) }}>
    {{ $slot }}
</button>

