{{--Заказ в списке--}}
<div class="Order Order_anons">
    <div class="Order-personal">
        <div class="row">
            <div class="row-block">
                <a class="Order-title" href="{{ route('account.orders.show', 123) }}">Заказ&#32;
                    <span class="Order-numberOrder">№{{ $order['number'] }}</span>&#32;от&#32;
                    <span class="Order-dateOrder">{{ $order['date'] }}</span>
                </a>
            </div>

            <div class="row-block">
                <div class="Order-info Order-info_delivery">
                    <div class="Order-infoType">Тип доставки:</div>
                    <div class="Order-infoContent">{{ $order['delivery'] }}</div>
                </div>
                <div class="Order-info Order-info_pay">
                    <div class="Order-infoType">Оплата:</div>
                    <div class="Order-infoContent">{{ $order['payment'] }}</div>
                </div>
                <div class="Order-info">
                    <div class="Order-infoType">Общая стоимость:</div>
                    <div class="Order-infoContent">
                        <span class="Order-price">@price($order['total'])$</span>
                        @isset($order['oldTotal'])
                            <span class="Order-price_old">@price($order['oldTotal'])$</span>
                        @endisset
                    </div>
                </div>
                <div class="Order-info Order-info_status">
                    <div class="Order-infoType">Статус:</div>
                    <div class="Order-infoContent">{{ $order['status'] }}</div>
                </div>

                @isset($order['warning'])
                    <div class="Order-info Order-info_error">
                        <div class="Order-infoType">Оплата не прошла:
                        </div>
                        <div class="Order-infoContent">{{ $order['warning'] }}</div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
