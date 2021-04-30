@props(['products'])
<div class="wrap">
    @foreach($products as $product)
        <x-cart.cart-product
            :product="$product"
        />
    @endforeach
    <x-cart.cart-total />
</div>
