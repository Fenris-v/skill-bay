<?php


namespace App\Contracts;


use App\Models\Order;

/**
 * Class OrderPaymentService
 *
 * @author Roman Sarvarov <roman.sarvarov@gmail.com>
 */
interface OrderPaymentService
{
    /**
     * Оплатить заказ.
     *
     * @param  Order  $order
     * @return bool
     */
    public function pay(Order $order);

    /**
     * Был ли заказ оплачен?
     *
     * @param  Order  $order
     * @return bool
     */
    public function isPaid(Order $order);
}
