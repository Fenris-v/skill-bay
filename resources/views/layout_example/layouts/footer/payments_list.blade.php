{{--Варианты оплаты--}}
@php
$payments = [
    [
        'icon' => '/assets/img/payments/visa.png',
        'alt' => 'visa.png',
    ],
    [
        'icon' => '/assets/img/payments/mastercard.png',
        'alt' => 'mastercard.png',
    ],
    [
        'icon' => '/assets/img/payments/paypal.png',
        'alt' => 'paypal.png',
    ],
    [
        'icon' => '/assets/img/payments/american.png',
        'alt' => 'american.png',
    ],
    [
        'icon' => '/assets/img/payments/electron.png',
        'alt' => 'electron.png',
    ],
    [
        'icon' => '/assets/img/payments/maestro.png',
        'alt' => 'maestro.png',
    ],
    [
        'icon' => '/assets/img/payments/delta.png',
        'alt' => 'delta.png',
    ],
    [
        'icon' => '/assets/img/payments/e.png',
        'alt' => 'e.png',
    ],
    [
        'icon' => '/assets/img/payments/dk.png',
        'alt' => 'dk.png',
    ],
];
@endphp
<div class="Footer-payments">
    @each('layouts.footer.payment_item', $payments, 'payment')
</div>
