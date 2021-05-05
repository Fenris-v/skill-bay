{{--Основной шаблон футера--}}
<footer class="Footer">
    <div class="wrap">
        <div class="row Footer-main">
            <div class="row-block">
                @include('layouts.blocks.logo', ['class' => 'Footer-logo', 'img' => '/assets/img/logo_footer.png'])

                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut
                    laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad</p>

                <x-socials position="footer"/>
            </div>

            <div class="row-block">
                @include('layouts.footer.nav_title', ['title' => 'Навигация'])

                <ul class="menu menu_vt Footer-menu">
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('index') }}">{{ __('navigation.main') }}</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('products.index') }}">{{ __('navigation.catalog') }}</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="sale.html">Скидки</a>
                    </li>
                </ul>
            </div>

            <div class="row-block">
                @include('layouts.footer.nav_title', ['title' => 'Дополнительно'])

                <ul class="menu menu_vt Footer-menu">
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('contacts') }}">{{ __('navigation.contacts') }}</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('about') }}">{{ __('navigation.about') }}</a>
                    </li>
                </ul>
            </div>

            <x-footer-contacts />
        </div>
    </div>

    <div class="Footer-copy">
        <div class="wrap">
            <div class="row row_space">
                <div class="row-block">©
                    <a href="{{ route('index') }}">Megano.</a>&#32;Все права защищены.
                </div>

                <div class="row-block">
                    <span>Способы оплаты</span>

                    @include('layouts.footer.payments_list')
                </div>
            </div>
        </div>
    </div>
</footer>
