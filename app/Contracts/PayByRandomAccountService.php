<?php

namespace App\Contracts;

use App\Models\Order;

interface PayByRandomAccountService
{
    public function pay(Order $order);
}
