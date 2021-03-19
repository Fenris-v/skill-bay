{{--Шаблон кнопки с выпадающим меню каталога--}}
<div class="Header-categories">
    <div class="CategoriesButton">
        <div class="CategoriesButton-title">
            <div class="CategoriesButton-icon">
                <img src="/assets/img/icons/allDep.svg" alt="allDep.svg"/>
            </div>
            <span class="CategoriesButton-text">All Departments</span>
            <div class="CategoriesButton-arrow">
            </div>
        </div>

        @include('layouts.header.categories_dropdown')
    </div>
</div>
