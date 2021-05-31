@props(['href', 'icon' => null, 'title' => null])
<a {{ $attributes->merge(['class' => 'btn']) }} href="{{ $href }}">
    @if($icon)
        <x-dynamic-component :component="$icon" />
    @endif
    @if($title)
        <span class="btn-content">{{ $title }}</span>
    @endif
</a>