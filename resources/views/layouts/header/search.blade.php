{{--Строка поиска--}}
<div class="Header-searchLink">
    <img src="/assets/img/icons/search.svg" alt="search.svg"/>
</div>
<div class="Header-search">
    <div class="search">
        <form class="form form_search" action="{{ route('products.index') }}" method="get">
            <input class="search-input" id="query" name="filter[title]" type="text"
                   value="{{ request()->get('filter')['title'] ?? '' }}" placeholder="Найти..."/>
            <button class="search-button" type="submit" name="search" id="search">
                <img src="/assets/img/icons/search.svg" alt="search.svg"/>Поиск</button>
        </form>
    </div>
</div>
