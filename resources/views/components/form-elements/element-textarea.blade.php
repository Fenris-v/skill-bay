@props(['name', 'label', 'value' => ''])
<x-form-elements.form-group
    label="{{ $label }}"
    name="{{ $name }}"
>
    <textarea
        class="form-textarea"
        name="{{ $name }}"
        id="{{ $name }}"
    >
        {{ $value }}
    </textarea>
</x-form-elements.form-group>