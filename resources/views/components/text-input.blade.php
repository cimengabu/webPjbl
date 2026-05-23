@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border border-white/10 bg-[#050B14] text-white focus:border-emerald-500 focus:ring focus:ring-emerald-500/20 rounded-2xl p-4 outline-none transition-all']) }}>

