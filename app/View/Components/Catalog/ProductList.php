<?php

namespace App\View\Components\Catalog;

use Closure;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ProductList extends Component
{
    public string $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Paginator|Collection $products, string $class = '')
    {
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.catalog.product-list');
    }
}
