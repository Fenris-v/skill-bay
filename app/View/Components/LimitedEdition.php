<?php

namespace App\View\Components;

use App\Services\LimitedEditionService;
use Illuminate\View\Component;

class LimitedEdition extends Component
{

    private $limitedEditionService;
    public $products;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(LimitedEditionService $limitedEditionService)
    {
        $this->limitedEditionService = $limitedEditionService;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->products = $this->limitedEditionService->get();
        return view('components.limited-edition');
    }
}
