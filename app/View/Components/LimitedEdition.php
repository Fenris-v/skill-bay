<?php

namespace App\View\Components;

use App\Services\LimitedEditionProductService;
use Illuminate\View\Component;
use App\Models\Product;

class LimitedEdition extends Component
{
    /**
     * @var LimitedEditionProductService
     */
    private $limitedEditionProductService;

    /**
     * @var Product
     */
    public $products;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(LimitedEditionProductService $limitedEditionProductService)
    {
        $this->limitedEditionProductService = $limitedEditionProductService;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->products = $this->limitedEditionProductService->get();
        return view('components.limited-edition');
    }
}
