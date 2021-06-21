<div class="Order">
    <div class="Order-infoBlock">
        <div class="Order-personal">
            <div class="row">
                <div class="row-block">
                    <div class="Order-info Order-info_date">
                        <div class="Order-infoType">
                            {{ __('orders.history.date') }}:
                        </div>
                        <div class="Order-infoContent">
                            {{ $order->created_at->format('d.m.Y') }}
                        </div>
                    </div>
                    <div class="Order-info">
                        <div class="Order-infoType">
                            {{ __('orders.history.full_name') }}:
                        </div>
                        <div class="Order-infoContent">
                            {{ $order->user->name }}
                        </div>
                    </div>
                    <div class="Order-info">
                        <div class="Order-infoType">
                            {{ __('orders.history.phone') }}:
                        </div>
                        <div class="Order-infoContent">
                            {{ $order->phone }}
                        </div>
                    </div>
                    <div class="Order-info">
                        <div class="Order-infoType">
                            {{ __('orders.history.email') }}:
                        </div>
                        <div class="Order-infoContent">
                            {{ $order->user->email }}
                        </div>
                    </div>
                </div>
                <div class="row-block">
                    <div class="Order-info Order-info_delivery">
                        <div class="Order-infoType">
                            {{ __('orders.history.delivery_type') }}:
                        </div>
                        <div class="Order-infoContent">
                            {{ $order->deliveryType->name }}
                        </div>
                    </div>
                    <div class="Order-info">
                        <div class="Order-infoType">
                            {{ __('orders.history.city') }}:
                        </div>
                        <div class="Order-infoContent">
                            {{ $order->city }}
                        </div>
                    </div>
                    <div class="Order-info">
                        <div class="Order-infoType">
                            {{ __('orders.history.address') }}:
                        </div>
                        <div class="Order-infoContent">
                            {{ $order->address }}
                        </div>
                    </div>
                    <div class="Order-info Order-info_pay">
                        <div class="Order-infoType">
                            {{ __('orders.history.payment_type') }}:
                        </div>
                        <div class="Order-infoContent">
                            {{ $order->paymentType->name }}
                        </div>
                    </div>
                    <div class="Order-info Order-info_status">
                        <div class="Order-infoType">
                            {{ __('orders.history.status') }}:
                        </div>
                        <div class="Order-infoContent">
                            @if($isPaid)
                                {{ __('orders.history.paid') }}
                            @else
                                {{ __('orders.history.not_paid') }}
                            @endif
                        </div>
                    </div>
                    @if($payError)
                        <div class="Order-info Order-info_error">
                            <div class="Order-infoType">
                                {{ __('orders.history.paid_error') }}:
                            </div>
                            <div class="Order-infoContent">
                                {{ $payError }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="Cart Cart_order">
            @foreach($order->cart->products as $product)
                <div class="Cart-product">
                    <div class="Cart-block Cart-block_row">
                        <div class="Cart-block Cart-block_pict">
                            <a class="Cart-pict" href="{{ route('products.show', $product) }}">
                                <img class="Cart-img" src="{{ $product->image->relativeUrl }}"
                                     alt="{{ $product->image->alt }}"/>
                            </a>
                        </div>
                        <div class="Cart-block Cart-block_info">
                            <a class="Cart-title"
                               href="{{ route('products.show', $product) }}">{{ $product->title }}</a>
                            <div class="Cart-desc">
                                {{ $product->description }}
                            </div>
                        </div>
                        <div class="Cart-block Cart-block_price">
                            @if($product->pivot->used_discount)
                                <div class="Cart-price Cart-price_old">
                                    <nobr>@price($product->pivot->used_discount + $product->pivot->used_price)</nobr>
                                </div>
                            @endif
                            <div class="Cart-price">
                                <nobr>@price($product->pivot->used_price)</nobr>
                            </div>
                        </div>
                    </div>
                    <div class="Cart-block Cart-block_row">
                        <div class="Cart-block Cart-block_seller">
                            <div>
                                {{ __('catalog.seller') }}:
                            </div>
                            <div>
                                {{ $product->cart->productSeller->title }}
                            </div>
                        </div>
                        <div class="Cart-block Cart-block_amount">
                            {{ $product->amount }} {{ __('orders.history.unit') }}
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="Cart-total">
                <div class="Cart-block Cart-block_total">
                    <strong class="Cart-title">{{ __('orders.history.total') }}:
                        <span class="Cart-price">@price($order->used_price)</span>
                        @if($order->used_discount)
                            <span class="Cart-price_old">@price($order->used_discount + $order->used_price)</span>
                        @endif
                    </strong>
                </div>

                @unless($isPaid)
                    <div class="Cart-block">
                        <a class="btn btn_primary btn_lg" href="{{ route('order.pay', compact('order')) }}">{{ __('orders.history.pay') }}</a>
                    </div>
                @endunless
            </div>
        </div>
    </div>
</div>
