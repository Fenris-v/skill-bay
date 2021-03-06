@props(['links', 'active'])
<div {{ $attributes->merge(['class' => 'Tabs Tabs_default']) }}>
    <div class="Tabs-links">
        @foreach($links as $key => $link)
            <a class="Tabs-link {{ $active === $link['id'] ? 'Tabs-link_ACTIVE' : '' }}" href="{{ $link['id'] }}"><span>{{ $link['title'] }}</span></a>
        @endforeach
    </div>
    <div class="Tabs-wrap">
        {{ $slot }}
    </div>
</div>
