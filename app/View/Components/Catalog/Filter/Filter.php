<?php

namespace App\View\Components\Catalog\Filter;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Filter extends Component
{
    public ?array $filterPrice;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public Collection $sellers,
        public Collection $specifications,
        public Collection $specificationsValues,
        public array $minMaxPrice,
        public Request $request
    ) {
        $this->filterPrice = isset($request->get('filter')['price'])
            ? explode(';', $request->get('filter')['price'])
            : null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.catalog.filter.filter');
    }
}
