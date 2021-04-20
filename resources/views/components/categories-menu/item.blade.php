{{--Элемент выпадающего меню--}}

@props(['node'])

<div class="CategoriesButton-link"><a href="{{ route('products.index', $node->slug) }}">
        <x-categories-menu.icon :icon="$node->icon"/>
        <span class="CategoriesButton-text">{{ $node->name }}</span></a>
    @if($node->children->count())
        <a class="CategoriesButton-arrow" href="{{ route('products.index', $node->slug) }}"></a>
        <div class="CategoriesButton-submenu">
            @foreach($node->children as $childNode)
                <x-categories-menu.item :node="$childNode"/>
            @endforeach
        </div>
    @endif
</div>
