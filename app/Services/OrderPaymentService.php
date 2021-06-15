<?php

namespace App\Services;

use App\Contracts\OrderPaymentService as OrderPaymentServiceContract;
use App\Exceptions\OrderPaymentException;
use App\Jobs\PayOrder;
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
     * @param  Order  $order
     * @throws OrderPaymentException
     * @return bool
     */
    public function pay(Order $order)
    {
        $order->refresh();

        if ($this->isPaid($order)) {
            throw new OrderPaymentException(__('payment.already_payed'));
        }

        $cardNumber = $order->payment_card;
        $paymentSum = $order->cart->currentPrice ?? null;

        dispatch(new PayOrder($order, $cardNumber, $paymentSum));

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
        return $order->payment_status === Order::PAYMENT_STATUS_PAYED;
    }

    /**
     * Текст ошибки, если заказ не оплачен.
     *
     * @param Order $order
     * @return string
     */
    public function getErrorMessage(Order $order)
    {
        return $order->payment_error_message ?? __('payment.error');
    }
}
