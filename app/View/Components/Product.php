<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Product as ProductModel;
use Illuminate\Support\Collection;
use App\Services\DiscountService;

class Product extends Component
{
    public ProductModel $product;
    public int $discount;
    public float $price;
    public float $priceOld;
    public string $compareUrl;
    public string $addToCartUrl;
    public Collection $sellers;

    public function __construct(ProductModel $product, DiscountService $discountService)
    {
        $this->product = $product;
        $this->discount = $discountService->getDiscountPrice($product) ?? 0;
        $this->priceOld = $product->averagePrice;
        $this->price = $product->currentPrice;
        $this->compareUrl = route('products.addToCompare', ['slug' => $product->slug]);
        $this->addToCartUrl = route('products.addToCart', ['slug' => $product->slug]);
        $this->sellers = $product->sellers->map(function ($seller) use ($product) {
            $seller->addToCartUrl = route(
                'products.addToCartWithSeller',
                ['productSlug' => $product->slug, 'sellerSlug' => $seller->slug]
            );
            $seller->sellerUrl = route(
                'sellers',
                ['seller' => $seller->slug]
            );
            return $seller;
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.product');
    }
}
