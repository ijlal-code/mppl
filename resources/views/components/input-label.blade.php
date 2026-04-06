@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-extrabold text-sm text-black']) }}>
    {{ $value ?? $slot }}
</label>