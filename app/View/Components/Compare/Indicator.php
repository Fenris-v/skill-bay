<?php

namespace App\View\Components\Compare;

use App\Services\CompareProductsService;
use Illuminate\View\Component;

class Indicator extends Component
{
    private $compareProductsService;
    public $amount;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(CompareProductsService $compareProductsService)
    {
        $this->compareProductsService = $compareProductsService;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->amount = $this->compareProductsService->count();
        return view('components.compare.indicator');
    }
}
