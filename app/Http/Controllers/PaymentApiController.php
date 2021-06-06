<?php

namespace App\Http\Controllers;

use App\Contracts\PaymentService;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentApiController extends Controller
{
    /**
     * Производит оплату заказа.
     *
     * @param  Request  $request
     * @param  Order  $order
     * @param  PaymentService  $paymentService
     * @return bool[]
     */
    public function payOrder(
        Request $request,
        Order $order,
        PaymentService $paymentService
    ) {
        $request->validate([
            'cardNumber' => ['required'],
            'paymentSum' => ['required'],
        ]);

        $cardNumber = $request->get('cardNumber');
        $paymentSum = $request->get('paymentSum');

        try {
            $paymentService->pay($order->id, $cardNumber, $paymentSum);
        } catch (\Throwable $e) {
            abort(400, $e->getMessage());
        }

        return ['success' => true];
    }
}
