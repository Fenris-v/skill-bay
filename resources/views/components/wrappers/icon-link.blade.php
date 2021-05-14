@props(['href', 'icon'])

<a {{ $attributes->merge(['class' => 'Card-btn']) }} href="{{ $href }}">
    <x-dynamic-component :component="$icon" />
</a>
