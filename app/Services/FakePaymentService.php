<?php

namespace App\Services;

use App\Contracts\PaymentService as PaymentServiceContract;

class FakePaymentService implements PaymentServiceContract
{
    /**
     * Производит оплату заказа.
     *
     * @param  int  $orderId
     * @param  string  $cardNumber
     * @param  float  $paymentSum
     * @return bool
     */
    public function pay(int $orderId, string $cardNumber, float $paymentSum): bool
    {
        if ($this->isCardNumberValid($cardNumber)) {
            // @todo payment process

            return true;
        }

        throw new \LogicException(__('payment.error'));
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
