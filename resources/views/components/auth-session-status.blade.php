@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-bold text-sm text-emerald-400']) }}>
        {{ $status }}
    </div>
@endif

