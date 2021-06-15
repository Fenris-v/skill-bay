<?php

namespace App\Console\Commands;

use App\Contracts\OrderPaymentService;
use App\Models\Order;
use Illuminate\Console\Command;

class PayOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:pay {orderId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Производит оплату заказа';

    /**
     * @var OrderPaymentService
     */
    protected OrderPaymentService $orderPaymentService;

    /**
     * Create a new command instance.
     *
     * @param  OrderPaymentService  $orderPaymentService
     */
    public function __construct(OrderPaymentService $orderPaymentService)
    {
        parent::__construct();

        $this->orderPaymentService = $orderPaymentService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $order = Order::find($this->argument('orderId'));

        if (is_null($order)) {
            $this->error('Заказ не найден.');
            return Command::FAILURE;
        }

        $this->line('Пытаемся оплатить заказ...');

        try {
            $this->orderPaymentService->pay($order);

            $this->info('Успешный запрос в сервис оплаты.');
        } catch (\Exception $e) {
            $this->error($e->getMessage());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
