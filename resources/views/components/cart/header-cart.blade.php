<a class="CartBlock-block" href="{{ route('cart.show') }}">
    <img class="CartBlock-img" src="/assets/img/icons/cart.svg" alt="cart.svg"/>
    @include('layouts.blocks.counter', ['amount' => $amount])
</a>
<div class="CartBlock-block">
    @include('layouts.header.cart_block_price', ['price' => $price])
</div>