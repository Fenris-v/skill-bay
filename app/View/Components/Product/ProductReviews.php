<?php

namespace App\View\Components\Product;

use App\Contracts\ProductReviewService;
use App\Models\Product;
use App\Models\ProductReview;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ProductReviews extends Component
{
    /**
     * @var Product
     */
    public $product;

    /**
     * @var Collection|ProductReview[]
     */
    public $reviews;

    /**
     * Create a new component instance.
     *
     * @param  Product  $product
     * @param  ProductReviewService  $productReviewService
     */
    public function __construct(Product $product, ProductReviewService $productReviewService)
    {
        $this->product = $product;
        $this->reviews = $productReviewService->getReviewListPaginator($product);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.product.product-reviews');
    }
}
