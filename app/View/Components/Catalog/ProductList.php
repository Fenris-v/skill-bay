<?php

namespace App\View\Components\Catalog;

use App\Models\Discount;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ProductList extends Component
{
    public string $class;
    public bool $hideDetails = false;

    /**
     * Create a new component instance.
     *
     * @param  Paginator|Collection  $products
     * @param  Collection  $discounts
     * @param  string  $class
     * @param  bool  $hideDetails
     */
    public function __construct(
        public Paginator|Collection $products,
        public Collection $discounts,
        string $class = '',
        bool $hideDetails = false,
    ) {
        $this->class = $class;
        $this->hideDetails = $hideDetails;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.catalog.product-list');
    }

    /**
     * Возвращает скидку по модели продукта
     * @param $product
     * @return Discount|null
     */
    public function getDiscount($product): ?Discount
    {
        return $this->discounts->get($product->slug) ?? null;
    }
}
