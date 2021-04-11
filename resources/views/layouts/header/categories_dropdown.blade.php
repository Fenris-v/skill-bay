{{--Выпадающее меню с категориями--}}
<div class="CategoriesButton-content">
    @forelse(App\Models\Category::whereIsRoot()->get() as $node)
        @include('layouts.header.dropdown_item', ['node' => $node])
    @empty
        <span class="CategoriesButton-text">Нет категорий</span>
    @endforelse
</div>
