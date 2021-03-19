{{--История заказов--}}
@php
    $orders = [
        [
            'number' => '200',
            'date' => '21.07.2020',
            'delivery' => 'Обычная доставка',
            'payment' => 'Онлайн картой',
            'oldTotal' => '230.99',
            'total' => '200.99',
            'status' => 'Не оплачен',
        ],
        [
            'number' => '199',
            'date' => '20.07.2020',
            'delivery' => 'Обычная доставка',
            'payment' => 'Онлайн картой',
            'total' => '100.99',
            'status' => 'Не оплачен',
            'warning' => 'Оплата не выполнена, т.к. вы подозреваетесь в нетолерантности'
        ],
        [
            'number' => '194',
            'date' => '01.07.2020',
            'delivery' => 'Обычная доставка',
            'payment' => 'Онлайн картой',
            'total' => '200.99',
            'status' => 'Не оплачен',
        ],
    ];
@endphp
<div class="Orders">
    @each('pages.account.blocks.orders.order', $orders, 'order')
</div>
