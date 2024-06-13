@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-bold uppercase mb-2']) }}>
    {{ $value ?? $slot }}
</label>
