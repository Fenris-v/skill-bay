<div class="Order-block Order-block_OPEN">
    <header class="Section-header Section-header_sm">
        <h2 class="Section-title">{{ __('orderPage.steps.accept') }}</h2>
    </header>
    <div class="Order-infoBlock">
        <div class="Order-personal">
            <div class="row">
                <div class="row-block">
                    <x-order.accept-info-block
                        :title="__('orderPage.formElements.personal.fullName.label')"
                        :value="$order?->user?->name"
                    />
                    <x-order.accept-info-block
                        :title="__('orderPage.formElements.personal.phone.label')"
                        :value="$phone"
                    />
                    <x-order.accept-info-block
                        :title="__('orderPage.formElements.personal.email.label')"
                        :value="$order?->user?->email"
                    />
                </div>
                <div class="row-block">
                    <x-order.accept-info-block
                        :title="__('orderPage.formElements.delivery.type.label')"
                        :value="$order?->deliveryType?->name"
                    />
                    <x-order.accept-info-block
                        :title="__('orderPage.formElements.delivery.city.label')"
                        :value="$order?->city"
                    />
                    <x-order.accept-info-block
                        :title="__('orderPage.formElements.delivery.address.label')"
                        :value="$order?->address"
                    />
                    <x-order.accept-info-block
                        :title="__('orderPage.formElements.payment.type.label')"
                        :value="$order?->paymentType?->name"
                    />
                </div>
            </div>
        </div>
    </div>
    <div class="Cart Cart_order">
        @foreach($products as $product)
            <x-product.product-handler>
                <x-slot name="productBlockSlot">
                    <x-product.product-block
                        :product="$product"
                        :productLink="route('products.show', $product->slug)"
                        :price="$product->price"
                        :priceOld="$product->price"
                    />
                </x-slot>
                <x-slot name="sellerBlockSlot">
                    <div>
                        {{ __('orderPage.titles.seller') }}:
                    </div>
                    <div>
                        {{ $product->pivot->seller->title }}
                    </div>
                </x-slot>
                <x-slot name="amountBlockSlot">
                    {{ $product->amount }} {{ __('orderPage.titles.amount') }}
                </x-slot>
                <x-slot name="deleteBlockSlot">
                </x-slot>
            </x-product.product-handler>
        @endforeach
        <x-cart.cart-total>
            <x-buttons.to-pay />
        </x-cart.cart-total>
    </div>
</div>