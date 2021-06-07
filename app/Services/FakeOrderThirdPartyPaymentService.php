<?php

namespace App\Services;

use App\Contracts\OrderThirdPartyPaymentService as OrderThirdPartyPaymentServiceContract;
use App\Exceptions\OrderPaymentException;

class FakeOrderThirdPartyPaymentService implements OrderThirdPartyPaymentServiceContract
{
    /**
     * Производит оплату заказа.
     *
     * @param  int  $orderId
     * @param  string  $cardNumber
     * @param  float  $paymentSum
     * @throws \Exception
     * @return bool
     */
    public function pay(int $orderId, string $cardNumber, float $paymentSum): bool
    {
        if ($this->isCardNumberValid($cardNumber)) {
            // @todo payment process

            return true;
        }

        switch (random_int(0, 3)) {
            case 0:
                throw new OrderPaymentException(__('payment.error_blocked'));
            case 1:
                throw new OrderPaymentException(__('payment.error_not_enough_money'));
            case 2:
                throw new OrderPaymentException(__('payment.error_bad_card'));
            case 3:
                throw new OrderPaymentException(__('payment.error_card_is_expire'));
        }

        return false;
    }

    /**
     * Валиден ли номер карты.
     *
     * @param  string  $cardNumber
     * @return bool
     */
    protected function isCardNumberValid(string $cardNumber)
    {
        $isLastCardDigitIsNotZero = (int)substr($cardNumber, -1) !== 0;
        $isCardNumberEven = $cardNumber % 2 === 0;

        return $isLastCardDigitIsNotZero || $isCardNumberEven;
    }
}
