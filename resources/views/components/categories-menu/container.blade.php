{{--Выпадающее меню с категориями--}}
<div class="CategoriesButton-content">
    @forelse($roots as $node)
        <x-categories-menu.item :node="$node"></x-categories-menu.item>
    @empty
        <span class="CategoriesButton-text">Нет категорий</span>
    @endforelse
</div>
