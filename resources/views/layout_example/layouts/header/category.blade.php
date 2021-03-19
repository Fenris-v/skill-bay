<a {!! isset($isSubmenu) ? 'class="CategoriesButton-link"' : '' !!}
   href="{{ $item['link'] ?? '#' }}">
    <div class="CategoriesButton-icon">
        <img src="{{ $item['icon'] ?? '' }}" alt="{{ $item['alt'] ?? '' }}"/>
    </div>
    <span class="CategoriesButton-text">{{ $item['name'] ?? '' }}</span>

    @isset($item['submenu'])
        <a class="CategoriesButton-arrow" href="#"></a>
        <div class="CategoriesButton-submenu">
            @foreach($item['submenu'] as $item)
                @include('layouts.header.category', ['item' => $item, 'isSubmenu' => true])
            @endforeach
        </div>
    @endisset
</a>
