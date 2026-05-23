@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-xs font-black uppercase text-gray-400 mb-2 tracking-widest']) }}>
    {{ $value ?? $slot }}
</label>

