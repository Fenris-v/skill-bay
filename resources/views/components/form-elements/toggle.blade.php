@props(['name', 'title', 'value', 'checked' => false])
<div>
    <label class="toggle">
        <x-form-elements.input
            name="{{ $name }}"
            value="{{ $value }}"
            type="radio"
            checked="{{ $checked }}"
        />
        <span class="toggle-box"></span>
        <span class="toggle-text">{{ $title }}</span>
    </label>
</div>