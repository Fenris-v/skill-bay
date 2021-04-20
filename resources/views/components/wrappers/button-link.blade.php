@props(['href', 'icon', 'title' => null])
<a {{ $attributes->merge(['class' => 'btn']) }} href="{{ $href }}">
    <x-dynamic-component :component="$icon" />
    @if($title)
        <span class="btn-content">{{ $title }}</span>
    @endif
</a>