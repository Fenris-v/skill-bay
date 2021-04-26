{{--Блок с кнопками сравнения и корзины в хэдере--}}
<div class="CartBlock">
    <a class="CartBlock-block" href="compare.html">
        <img class="CartBlock-img"
             src="/assets/img/icons/exchange.svg"
             alt="exchange.svg"/>
        @include('layouts.blocks.counter', compact($amount = 4))
    </a>
    <x-cart.header-cart />
</div>
