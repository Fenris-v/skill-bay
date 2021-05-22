@props(['name', 'items' => []])
<x-form-elements.form-group name="{{ $name }}">
    @foreach($items as $item)
        @if((int) old($name) === (int) $item['value'] || $item['checked'])
        <x-form-elements.toggle
            name="{{ $name }}"
            title="{{ $item['title'] }}"
            value="{{ $item['value'] }}"
            checked="checked"
        />
        @else
        <x-form-elements.toggle
            name="{{ $name }}"
            title="{{ $item['title'] }}"
            value="{{ $item['value'] }}"
        />
        @endif
    @endforeach
</x-form-elements.form-group>