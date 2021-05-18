@props(['icon' => false, 'title' => null])
<button {{ $attributes->merge(['type' => 'button']) }}>
    @if($icon)
        <x-dynamic-component :component="$icon" />
    @endif
    @if($title)
        <span class="btn-content">{{ $title }}</span>
    @endif
</button>