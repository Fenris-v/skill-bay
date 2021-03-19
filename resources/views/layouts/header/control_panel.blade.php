{{--Верхняя панель в хэдере--}}
<div class="ControlPanel">
    <div class="wrap">
        <div class="row ControlPanel-row">
            <div class="row-block">
                <div class="row ControlPanel-rowSplit">
                    <div class="row-block">
                        <a class="ControlPanel-title" href="#">Free Delivery</a>
                    </div>
                    <div class="row-block hide_700">
                        <span class="ControlPanel-title">Follow Us</span>
                        <ul class="menu menu_img menu_smallImg ControlPanel-menu">
                            <li class="menu-item">
                                <a class="menu-link" href="#">
                                    <img src="assets/img/icons/socialHeader/fb.svg" alt="fb.svg"/>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link" href="#">
                                    <img src="assets/img/icons/socialHeader/tw.svg" alt="tw.svg"/>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link" href="#">
                                    <img src="assets/img/icons/socialHeader/in.svg" alt="in.svg"/>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link" href="#">
                                    <img src="assets/img/icons/socialHeader/pt.svg" alt="pt.svg"/>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link" href="#">
                                    <img src="assets/img/icons/socialHeader/mail.svg" alt="mail.svg"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <nav class="row-block">
                @include('layouts.header.auth')
            </nav>
        </div>
    </div>
    <!--+div.menuModal#navigate
    //    +menu([
    //        ['Главная','index.html'],
    //        ['Портфолио','index.html'],
    //        ['Мои проекты','index.html'],
    //        ['Контакты','index.html']
    //    ], page === 'article'? 'Портфолио': 'Главная')._main

    block
    -->
</div>
