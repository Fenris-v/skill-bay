@props(['items'])
<ul class="breadcrumbs Middle-breadcrumbs">
    @foreach($items as $item)
        <li {{ $attributes->class(['breadcrumbs-item', 'breadcrumbs-item_current' => $item['isCurrent']]) }}>
            @if(!$item['isCurrent'])
                <a href="index.html">{{ $item['title'] }}</a>
            @else
                <span>{{ $item['title'] }}</span>
            @endif
        </li>
    @endforeach
</ul>