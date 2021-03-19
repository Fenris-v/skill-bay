{{--Блок с кнопками сравнения и корзины в хэдере--}}
<div class="CartBlock">
    <a class="CartBlock-block" href="#">
        <img class="CartBlock-img"
             src="/assets/img/icons/exchange.svg"
             alt="exchange.svg"/>
        @include('layouts.blocks.counter', compact($amount = 4))
    </a>
    <a class="CartBlock-block" href="#">
        <img class="CartBlock-img" src="/assets/img/icons/cart.svg" alt="cart.svg"/>
        @include('layouts.blocks.counter', compact($amount = 0))
    </a>
    <div class="CartBlock-block">
        @include('layouts.header.cart_block_price')
    </div>
</div>
