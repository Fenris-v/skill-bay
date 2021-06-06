<?php

namespace App\Services;

use App\Contracts\PayByCardService as PayByCardServiceContract;
use App\Jobs\PayOrder;
use App\Models\Order;

class PayByCardService implements PayByCardServiceContract
{
    /**
     * Производит оплату заказа.
     *
     * @param  Order  $order
     * @param  string  $cardNumber
     */
    public function pay(Order $order, string $cardNumber)
    {
        if ($order->payment_status === Order::PAYMENT_STATUS_PAYED) {
            throw new \InvalidArgumentException(__('payment.already_payed'));
        }

        $paymentSum = $order->cart->currentPrice ?? null;

        dispatch(new PayOrder($order, $cardNumber, $paymentSum));

        true;
    }
}
