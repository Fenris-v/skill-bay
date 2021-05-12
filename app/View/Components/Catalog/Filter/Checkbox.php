<?php

namespace App\View\Components\Catalog\Filter;

use App\Models\Specification;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Specification $specification)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.catalog.filter.checkbox');
    }
}
