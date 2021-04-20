<?php

namespace App\View\Components\Catalog;

use App\Models\Product;
use App\Repository\ProductRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ProductTop extends Component
{
    /**
     * @var Collection|Product[]
     */
    public $products;

    /**
     * Create a new component instance.
     *
     * @param  ProductRepository  $productRepository
     * @throws \Exception
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->products = $productRepository->getTopProducts();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.catalog.product-top');
    }
}
