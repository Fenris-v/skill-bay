{{--Основной шаблон футера--}}
<footer class="Footer">
    <div class="wrap">
        <div class="row Footer-main">
            <div class="row-block">
                @include('layouts.blocks.logo', ['class' => 'Footer-logo', 'img' => '/assets/img/logo_footer.png'])

                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut
                    laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad</p>

                <ul class="menu menu_img menu_smallImg Footer-menuSoc">
                    <li class="menu-item">
                        <a class="menu-link" href="#">
                            <img src="assets/img/icons/socialFooter/fb.svg" alt="fb.svg"/>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">
                            <img src="assets/img/icons/socialFooter/tw.svg" alt="tw.svg"/>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">
                            <img src="assets/img/icons/socialFooter/in.svg" alt="in.svg"/>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">
                            <img src="assets/img/icons/socialFooter/pt.svg" alt="pt.svg"/>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">
                            <img src="assets/img/icons/socialFooter/mail.svg" alt="mail.svg"/>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="row-block">
                @include('layouts.footer.nav_title', ['title' => 'Useful Links'])

                <ul class="menu menu_vt Footer-menu">
                    <li class="menu-item">
                        <a class="menu-link" href="#">Checkout</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">My Cart</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">Delivery</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">Order Info</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">Terms</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">Conditions</a>
                    </li>
                </ul>
            </div>

            <div class="row-block">
                @include('layouts.footer.nav_title', ['title' => 'My Account'])

                <ul class="menu menu_vt Footer-menu">
                    <li class="menu-item">
                        <a class="menu-link" href="#">Accessories</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">Bags</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">Cameras</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">Clothings</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">Electronics</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">Fashion</a>
                    </li>
                </ul>
            </div>

            <div class="row-block">
                @include('layouts.footer.nav_title', ['title' => 'Contacts'])

                <p>Phone: 8.800.200.600<br>
                    Email: Support@ninzio.com<br>
                    Skype: techno<br>
                    Address: New York, north<br>
                    Avenue 26/7<br>
                    0057
                </p>
            </div>
        </div>
    </div>

    <div class="Footer-copy">
        <div class="wrap">
            <div class="row row_space">
                <div class="row-block">© Copyright&#32;
                    <a href="#">Megano Store.</a>
                    &#32;All rights reserved.
                </div>
                <div class="row-block">
                    <span>Accepted Payments</span>

                    @include('layouts.footer.payments_list')
                </div>
            </div>
        </div>
    </div>
</footer>
