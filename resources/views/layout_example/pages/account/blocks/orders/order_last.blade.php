{{--Последний заказ пользователя--}}
@php
    $order = [
        'number' => '200',
        'date' => '21.07.2020',
        'delivery' => 'Обычная доставка',
        'payment' => 'Онлайн картой',
        'total' => '200.99',
        'status' => 'Не оплачен',
    ];
@endphp
<div class="Account-group">
    <div class="Account-column Account-column_full">
        <div class="Order Order_anons">
            <div class="Order-personal">
                <div class="row">
                    <div class="row-block">
                        <a class="Order-title" href="{{ route('account.orders.show', 123) }}">Заказ&#32;
                            <span class="Order-numberOrder">№{{ $order['number'] }}</span>&#32;от&#32;
                            <span class="Order-dateOrder">{{ $order['date'] }}</span>
                        </a>
                        <div class="Account-editLink">
                            <a href="{{ route('account.orders') }}">История заказов</a>
                        </div>
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
                            <div class="Order-infoContent">@price($order['total'])$</div>
                        </div>
                        <div class="Order-info Order-info_status">
                            <div class="Order-infoType">Статус:</div>
                            <div class="Order-infoContent">{{ $order['status'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
