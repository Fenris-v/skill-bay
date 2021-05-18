<?php

namespace App\View\Components;

use App\Repository\LimitedEditionProductRepository;
use App\Services\LimitedEditionProductService;
use Illuminate\View\Component;

class LimitedEdition extends Component
{

    private $limiredEditionProductService;
    public $products;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(LimitedEditionProductService $limiredEditionProductService)
    {
        $this->limiredEditionProductService = $limiredEditionProductService;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->products = $this->limiredEditionProductService->get();
        return view('components.limited-edition');
    }
}
