<?php

namespace App\Services;

class FakeBankCardNumberGenerator
{
    /**
     * Возвращает сгенерированный номер карты.
     *
     * @throws \Exception
     * @return int
     */
    public function generate()
    {
        return random_int(10000000, 99999999);
    }
}
