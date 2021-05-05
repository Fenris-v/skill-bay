{{--Элемент выпадающего меню--}}
<div class="CategoriesButton-link"><a href="{{ route('catalog_category', $node->slug) }}">
        <div class="CategoriesButton-icon"><img src="{{ $node->image->url() }}" alt="{{ $node->image->path }}"/>
        </div>
        <span class="CategoriesButton-text">{{ $node->name }}</span></a>
        @if($node->children->count())
            <a class="CategoriesButton-arrow" href="{{ route('catalog_category', $node->slug) }}"></a>
            <div class="CategoriesButton-submenu">
                @each('layouts.header.dropdown_item', $node->children, 'node')
            </div>
        @endif
</div>
