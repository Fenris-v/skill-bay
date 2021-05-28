<?php

namespace App\View\Components;

use App\Models\Discount;
use App\Models\Product as ProductModel;
use App\Services\DiscountService;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Product extends Component
{
    public ProductModel $product;
    public ?Discount $discount;
    public float $price;
    public float $priceOld;
    public string $compareUrl;
    public string $addToCartUrl;
    public Collection $sellers;

    public function __construct(ProductModel $product, DiscountService $discountService)
    {
        $this->product = $product;
        $this->discount = $discountService->getPriorityDiscount($product)->first();

        if ($this->discount) {
            $this->price = $discountService
                ->calculateDiscountPrice(
                    $product,
                    $this->discount,
                    $this->product->averagePrice
                );
        } else {
            $this->price = $this->product->averagePrice;
        }

        $this->priceOld = $product->averagePrice;
        $this->compareUrl = route('products.addToCompare', ['slug' => $product->slug]);
        $this->addToCartUrl = route('products.addToCart', ['slug' => $product->slug]);
        $this->sellers = $product->sellers->map(
            function ($seller) use ($product) {
                $seller->addToCartUrl = route(
                    'products.addToCartWithSeller',
                    ['productSlug' => $product->slug, 'sellerSlug' => $seller->slug]
                );
                $seller->sellerUrl = route(
                    'sellers',
                    ['seller' => $seller->slug]
                );
                return $seller;
            }
        );
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
