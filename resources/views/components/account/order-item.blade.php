<div class="Order Order_anons">
    <div class="Order-personal">
        <div class="row">
            <div class="row-block">
                <a class="Order-title" href="{{ route('orders.show', $order) }}">
                    {!! __('orders.history.title', ['number' => $order->id, 'date' => $order->created_at->format('d.m.Y')]) !!}
                </a>
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
                <div class="Order-info Order-info_pay">
                    <div class="Order-infoType">
                        {{ __('orders.history.payment_type') }}:
                    </div>
                    <div class="Order-infoContent">
                        {{ $order->paymentType->name }}
                    </div>
                </div>
                <div class="Order-info">
                    <div class="Order-infoType">
                        {{ __('orders.history.total_price') }}:
                    </div>
                    <div class="Order-infoContent">
                        <span class="Order-price">@price($order->price)</span>
                        @if($order->discount)
                            <span class="Order-price_old">@price($order->price_without_discount)</span>
                        @endif
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
</div>
