<?php

namespace App\View\Components\Account;

use App\Repository\OrdersRepository;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use \App\Models\Order as Model;

class Order extends Component
{
    public bool $isPaid;
    public ?string $payError = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Model $order, OrdersRepository $orders)
    {
        $this->isPaid = $orders->getPaymentStatus($this->order);

        if (!$this->isPaid) {
            $this->payError = $orders->getErrorMessage($this->order);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.account.order');
    }
}
