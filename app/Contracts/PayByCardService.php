<?php

namespace App\Contracts;

use App\Models\Order;

interface PayByCardService
{
    /**
     * Производит оплату заказа.
     *
     * @param  Order  $order
     * @param  string  $cardNumber
     */
    public function pay(Order $order, string $cardNumber);
}
