{{--Навигация в ЛК--}}
<div class="Section-column">
    <div class="Section-columnSection">
        @include('layouts.blocks.header_aside', ['title' => 'Навигация'])

        <div class="Section-columnContent">
            <div class="NavigateProfile">
                <ul class="menu menu_vt">
                    <li class="menu-item_ACTIVE menu-item">
                        <a class="menu-link" href="{{ route('account') }}">Личный кабинет</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('account.profile') }}">Профиль</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('account.orders') }}">История заказов</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('account.views') }}">История просмотра</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
