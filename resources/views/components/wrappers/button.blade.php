@props(['type' => 'button', 'icon', 'title' => null])
<button {{ $attributes->merge(['class' => 'btn']) }}>
    <x-dynamic-component :component="$icon" />
    @if($title)
        <span class="btn-content">{{ $title }}</span>
    @endif
</button>