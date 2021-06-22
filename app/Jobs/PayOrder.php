<?php

namespace App\Jobs;

use App\Contracts\OrderThirdPartyPaymentService;
use App\Exceptions\OrderPaymentException;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Validation\ValidationException;

class PayOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Order
     */
    protected Order $order;

    /**
     * @var string
     */
    protected string $cardNumber;

    /**
     * @var float
     */
    protected float $paymentSum;

    /**
     * Create a new job instance.
     * @param  Order  $order
     * @param  string  $cardNumber
     * @param  float  $paymentSum
     */
    public function __construct(Order $order, string $cardNumber, float $paymentSum)
    {
        $this->order = $order;
        $this->cardNumber = $cardNumber;
        $this->paymentSum = $paymentSum;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = $this->makeHttpRequestToThirdPartyPaymentApi([
            'orderId' => $this->order->id,
            'cardNumber' => $this->cardNumber,
            'paymentSum' => $this->paymentSum,
        ]);

        if ($response['success'] ?? false) {
            $this->order->payment_status = Order::PAYMENT_STATUS_PAYED;
            $this->order->payment_error_message = null;
        } else {
            $this->order->payment_status = Order::PAYMENT_STATUS_ERROR;
            $this->order->payment_error_message = $response['message'] ?? null;
        }

        $this->order->save();
    }

    /**
     * Делает запрос к стороннему API для оплаты заказа.
     *
     * @param  array  $requestData
     * @return array|bool[]
     */
    private function makeHttpRequestToThirdPartyPaymentApi(array $requestData)
    {
        sleep(1); // Fake request loading.

        $rules = [
            'orderId' => ['required', 'exists:orders,id'],
            'cardNumber' => ['required'],
            'paymentSum' => ['required'],
        ];

        try {
            \Validator::validate($requestData, $rules);

            app(OrderThirdPartyPaymentService::class)->pay(
                $requestData['orderId'],
                $requestData['cardNumber'],
                $requestData['paymentSum'],
            );
        } catch (OrderPaymentException|ValidationException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => __('payment.error')];
        }

        return ['success' => true];
    }
}
