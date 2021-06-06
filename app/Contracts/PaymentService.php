<?php

namespace App\Contracts;

interface PaymentService
{
    /**
     * Производит оплату заказа.
     *
     * @param  int  $orderId
     * @param  string  $cardNumber
     * @param  float  $paymentSum
     * @return bool
     */
    public function pay(int $orderId, string $cardNumber, float $paymentSum): bool;
}
