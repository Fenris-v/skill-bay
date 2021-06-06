<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        $response = \Http::asJson()->post("http://localhost/api/orders/{$this->order->id}/pay", [
            'cardNumber' => $this->cardNumber,
            'paymentSum' => $this->paymentSum,
        ]);

        if ($response->successful()) {
            $this->order->payment_status = Order::PAYMENT_STATUS_PAYED;
        } else {
            $this->order->payment_status = Order::PAYMENT_STATUS_ERROR;
        }

        $this->order->save();
    }
}
