{{--Основной шаблон хэдера--}}
<header class="Header">
    @include('layouts.header.control_panel')

    <div class="wrap">
        <div class="row Header-rowMain">
            <div class="row-block Header-logo">
                @include('layouts.blocks.logo')
            </div>
            <nav class="row-block row-block_right Header-menu">
                @include('layouts.header.navigate')
            </nav>
            <div class="row-block">
                @include('layouts.header.cart_block')
            </div>
            <div class="row-block Header-trigger">
                <a class="menuTrigger" href="#navigate">
                    <div class="menuTrigger-content">Показать навигацию</div>
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
            </div>
        </div>
    </div>
    <div class="Header-searchWrap">
        <div class="wrap">
            @include('layouts.header.categories')

            @include('layouts.header.search')
        </div>
    </div>
</header>
