{{--Фильтры--}}
<form class="form" action="#" method="post">
    <div class="form-group">
        @include('pages.catalog.filters.range')
    </div>
    <div class="form-group">
        @include('pages.catalog.filters.search')
    </div>
    <div class="form-group">
        @include('pages.catalog.filters.select')
    </div>
    <div class="form-group">
        @include('pages.catalog.filters.checkbox', ['val' => 'Только товары в наличии'])
    </div>
    <div class="form-group">
        @include('pages.catalog.filters.checkbox', ['val' => 'С бесплатной доставкой'])
    </div>
    <div class="form-group">
        <div class="buttons">
            <a class="btn btn_square btn_dark btn_narrow" href="#">Filter</a>
        </div>
    </div>
</form>
