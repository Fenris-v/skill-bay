<?php

namespace App\View\Components\Catalog\Filter;

use App\Models\Specification;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class Select extends Component
{
    public bool $filtering;
    public mixed $filterValue;
    public Collection $specificationsValues;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public Specification $specification,
        public Request $request,
        Collection $specificationsValues,
        public bool $multiple = false
    ) {
        $this->specificationsValues = $specificationsValues
            ->where('specification_id', $this->specification->id);

        $this->filtering = isset($request->get('filter')['props'][$specification->slug]);

        $this->filterValue = $this->filtering
            ? $request->get('filter')['props'][$specification->slug]
            : null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        if ($this->multiple) {
            return view('components.catalog.filter.multiple');
        }

        return view('components.catalog.filter.select');
    }
}
