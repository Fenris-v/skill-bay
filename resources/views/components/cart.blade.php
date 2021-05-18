@props(['products'])
<div class="wrap">
    @if($products->count())
        @foreach($products as $product)
            <x-cart.cart-product
                :product="$product"
            />
        @endforeach
        <x-cart.cart-total>
            <x-wrappers.button-link
                    class="btn_success btn_lg"
                    title="{{ __('cartPage.toOrder') }}"
                    :href="route('order.personal.get')"
            />
        </x-cart.cart-total>
    @else
        <strong>{{ __('cartPage.empty') }}</strong>
    @endif
</div>
