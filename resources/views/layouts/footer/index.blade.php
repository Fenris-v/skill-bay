{{--Основной шаблон футера--}}
<footer class="Footer">
    <div class="wrap">
        <div class="row Footer-main">
            <div class="row-block">
                @include('layouts.blocks.logo', ['class' => 'Footer-logo', 'img' => '/assets/img/logo_footer.png'])

                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut
                    laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad</p>

                <ul class="menu menu_img menu_smallImg Footer-menuSoc">
                    <li class="menu-item"><a class="menu-link" href="#"><img src="assets/img/icons/socialFooter/fb.svg" alt="fb.svg"/></a></li>
                    <li class="menu-item"><a class="menu-link" href="#"><img src="assets/img/icons/socialFooter/tw.svg" alt="tw.svg"/></a></li>
                    <li class="menu-item"><a class="menu-link" href="#"><img src="assets/img/icons/socialFooter/in.svg" alt="in.svg"/></a></li>
                </ul>
            </div>

            <div class="row-block">
                @include('layouts.footer.nav_title', ['title' => 'Навигация'])

                <ul class="menu menu_vt Footer-menu">
                    <li class="menu-item"><a class="menu-link" href="index.html">Главная</a></li>
                    <li class="menu-item"><a class="menu-link" href="catalog.html">Каталог</a></li>
                    <li class="menu-item"><a class="menu-link" href="sale.html">Скидки</a></li>
                </ul>
            </div>

            <div class="row-block">
                @include('layouts.footer.nav_title', ['title' => 'Дополнительно'])

                <ul class="menu menu_vt Footer-menu">
                    <li class="menu-item"><a class="menu-link" href="contacts.html">Контакты</a></li>
                    <li class="menu-item"><a class="menu-link" href="about.html">О нас</a></li>
                </ul>
            </div>

            <div class="row-block">
                @include('layouts.footer.nav_title', ['title' => 'Контакты'])

                <p>Тел: 8-800-200-600<br>
                    Email: megano@skillbox_diploma.com<br>
                    Адрес: Каменск-Уральский<br>
                    Заводской проезд, 1</p>
            </div>
        </div>
    </div>

    <div class="Footer-copy">
        <div class="wrap">
            <div class="row row_space">
                <div class="row-block">©
                    <a href="index.html">Megano.</a>&#32;Все права защищены.
                </div>

                <div class="row-block">
                    <span>Способы оплаты</span>

                    @include('layouts.footer.payments_list')
                </div>
            </div>
        </div>
    </div>
</footer>
