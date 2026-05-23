<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-red-600 border border-transparent rounded-2xl font-black text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 hover:shadow-[0_0_20px_rgba(239,68,68,0.4)] transition-all active:scale-95 outline-none']) }}>
    {{ $slot }}
</button>

