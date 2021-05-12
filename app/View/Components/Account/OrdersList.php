<?php

namespace App\View\Components\Account;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class OrdersList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Paginator|Collection $orders)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.account.orders-list');
    }
}
