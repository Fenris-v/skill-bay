<?php

namespace App\Services;

use App\Contracts\OrderPaymentService as OrderPaymentServiceContract;
use App\Models\Order;

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
     * @param Order $order
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
     * @param Order $order
     * @return bool
     */
    public function isPaid(Order $order): bool
    {
        // @todo Реализовать метод

        return $order->id % 2;
    }

    /**
     * Текст ошибки, если заказ не оплачен
     * @param Order $order
     * @return string
     */
    public function getErrorMessage(Order $order): string
    {
        // TODO: Реализовать метод
        return 'Оплата не выполнена, т.к. вы подозреваетесь в нетолерантности';
    }
}
