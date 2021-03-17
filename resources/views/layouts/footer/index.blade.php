{{--Основной шаблон футера--}}
@php
    $menu = [
        [
            'name' => 'Checkout',
            'link' => '#',
        ],
        [
            'name' => 'My Cart',
            'link' => '#',
        ],
        [
            'name' => 'Delivery',
            'link' => '#',
        ],
        [
            'name' => 'Order Info',
            'link' => '#',
        ],
        [
            'name' => 'Terms',
            'link' => '#',
        ],
        [
            'name' => 'Conditions',
            'link' => '#',
        ],
    ];
@endphp

<footer class="Footer">
    <div class="wrap">
        <div class="row Footer-main">
            <div class="row-block">
                @include('layouts.blocks.logo', ['class' => 'Footer-logo', 'img' => '/assets/img/logo_footer.png'])

                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincid unt ut
                    laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad</p>

                @include('layouts.blocks.socials.socials_list', ['isFooter' => true])
            </div>

            <div class="row-block">
                @include('layouts.footer.nav_title', ['title' => 'Useful Links'])

                @include('layouts.footer.nav', ['menu' => $menu])
            </div>

            <div class="row-block">
                @include('layouts.footer.nav_title', ['title' => 'My Account'])
                @php
                    $menu = [
                        [
                            'name' => 'Accessories',
                            'link' => '#',
                        ],
                        [
                            'name' => 'Bags',
                            'link' => '#',
                        ],
                        [
                            'name' => 'Cameras',
                            'link' => '#',
                        ],
                        [
                            'name' => 'Clothings',
                            'link' => '#',
                        ],
                        [
                            'name' => 'Electronics',
                            'link' => '#',
                        ],
                        [
                            'name' => 'Fashion',
                            'link' => '#',
                        ],
                    ];
                @endphp
                @include('layouts.footer.nav', ['menu' => $menu])
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
