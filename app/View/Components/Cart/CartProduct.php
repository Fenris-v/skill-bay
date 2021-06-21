<?php

namespace App\View\Components\Cart;

use App\Models\Discount;
use App\Models\Product;
use App\Services\DiscountService;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class CartProduct extends Component
{
    public string $productLink;
    public Product $product;
    public float $price;
    public float $priceOld;
    public Collection $sellers;
    public int $amount;
    public string $removeProductFromCartUrl;
    public string $changeProductSellerUrl;
    public string $changeProductAmountUrl;
    public ?Discount $discount;

    public function __construct(Product $product, ?Collection $discounts, DiscountService $service)
    {
        $this->discount = $discounts->get($product->slug) ?? null;
        $this->product = $product;
        $this->sellers = $product->sellers->map(
            fn($seller) => [
                'value' => $seller->slug,
                'title' => $seller->title,
                'selected' => $product->pivot->seller_id === $seller->id,
            ]
        );
        $this->productLink = route('products.show', $product->slug);
        $this->priceOld = $product->price;

        if ($this->discount?->type === Discount::PRODUCT) {
            $this->price = $service->calculateDiscountPrice(
                $product,
                $this->discount,
                $product->price
            );
        } else {
            $this->price = $product->price;
        }

        $this->amount = $product->amount;
        $this->removeProductFromCartUrl = route('cart.removeProduct', $product->slug);
        $this->changeProductSellerUrl = route('cart.changeProductSeller', $product->slug);
        $this->changeProductAmountUrl = route('cart.changeProductAmount', $product->slug);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart.cart-product');
    }
}
