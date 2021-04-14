<?php

namespace App\View\Components\Catalog;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductControl extends Component
{
    public $product;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.catalog.product-control');
    }
}
