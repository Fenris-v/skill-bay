@props(['name', 'items' => []])
<x-form-elements.form-group>
    @foreach($items as $item)
        <x-form-elements.toggle
            name="{{ $name }}"
            title="{{ $item['title'] }}"
            value="{{ $item['value'] }}"
            checked="{{ $item['checked'] }}"
        />
    @endforeach
</x-form-elements.form-group>