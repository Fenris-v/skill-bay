@props(['value'])
<input
    class="form-input"
    id="{{ $attributes->get('name') }}"
    {{ $attributes->merge(['type' => 'text']) }}
    value="{{ old($attributes->get('name')) ?? $value ?? null }}"
/>