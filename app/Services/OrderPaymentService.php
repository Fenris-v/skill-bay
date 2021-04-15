<?php

namespace App\Services;

use App\Models\Order;
use App\Contracts\OrderPaymentService as OrderPaymentServiceContract;

/**
 * Class OrderPaymentService
 *
 * @author Roman Sarvarov <roman.sarvarov@gmail.com>
 */
class OrderPaymentService implements OrderPaymentServiceContract
{
    /**
     * Оплатить заказ.
     *
     * @param  Order  $order
     * @return bool
     */
    public function pay(Order $order)
    {
        // @todo Реализовать метод

        return true;
    }

    /**
     * Был ли заказ оплачен?
     *
     * @param  Order  $order
     * @return bool
     */
    public function isPaid(Order $order)
    {
        // @todo Реализовать метод

        return true;
    }
}
