<?php

namespace App\View\Components\Cart;

use Illuminate\View\Component;
use App\Models\Product;
use Illuminate\Support\Collection;

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

    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->sellers = $product->sellers->map(fn($seller) => [
            'value' => $seller->slug,
            'title' => $seller->title,
            'selected' => $product->pivot->seller->id === $seller->id,
        ]);
        $this->productLink = route('products.show', $product->slug);
        $this->priceOld = $product->averagePrice;
        $this->price = $product->currentPrice;
        $this->amount = $product->pivot->amount;
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
