@props(['items'])
<ul class="breadcrumbs Middle-breadcrumbs">
    @foreach($items as $item)
        <li {{ $attributes->class(['breadcrumbs-item', 'breadcrumbs-item_current' => !isset($item['url'])]) }}>
            @if(isset($item['url']))
                <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
            @else
                <span>{{ $item['title'] }}</span>
            @endif
        </li>
    @endforeach
</ul>