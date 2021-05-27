@props(['products', 'discounts'])
<div class="wrap">
    @if($products->count())
        @foreach($products as $product)
            <x-cart.cart-product :product="$product" :discounts="$discounts"/>
        @endforeach
        <x-cart.cart-total :discounts="$discounts">
            <x-wrappers.button-link
                    class="btn_success btn_lg"
                    title="{{ __('cartPage.toOrder') }}"
                    :href="route('order.personal.get')" />
        </x-cart.cart-total>
    @else
        <strong>{{ __('cartPage.empty') }}</strong>
    @endif
</div>
