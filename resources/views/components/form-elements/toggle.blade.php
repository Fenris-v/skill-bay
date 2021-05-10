@props(['name', 'title', 'value'])
<div>
    <label class="toggle">
        <x-form-elements.input
            name="{{ $name }}"
            value="{{ $value }}"
            type="radio"
            {{ $attributes->merge() }}
        />
        <span class="toggle-box"></span>
        <span class="toggle-text">{{ $title }}</span>
    </label>
</div>