@props(['products'])
<div class="wrap">
    @if($products->count())
        @foreach($products as $product)
            <x-cart.cart-product
                :product="$product"
            />
        @endforeach
        <x-cart.cart-total />
    @else
        <strong>Ваша корзина пуста :(</strong>
    @endif
</div>
