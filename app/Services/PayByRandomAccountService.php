<?php

namespace App\Services;

use App\Models\Order;
use App\Contracts\PayByRandomAccountService as PayByRandomAccountServiceContract;

class PayByRandomAccountService implements PayByRandomAccountServiceContract
{
    public function pay(Order $order)
    {
        // TODO: Implement Pay() method.
    }
}
