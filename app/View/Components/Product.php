<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Product as ProductModel;
use Illuminate\Support\Collection;

class Product extends Component
{
    public ProductModel $product;
    public int $discount;
    public Collection $pics;
    public string $title;
    public string $description;
    public float $price;
    public float $priceOld;
    public string $compareUrl;
    public string $addToCartUrl;
    public Collection $sellers;
    public Collection $specifications;

    public function __construct(ProductModel $product)
    {
        $this->product = $product;
        $this->discount = 10;
        $this->title = $product->title;
        $this->pics = collect([
            ['url' => '/assets/img/content/home/bigGoods.png'],
            ['url' => '/assets/img/content/home/slider.png'],
            ['url' => '/assets/img/content/home/videoca.png'],
        ]);
        $this->description = $product->description;
        $this->priceOld = $product->sellers->avg('pivot.price') ?? 0;
        $this->price = $this->priceOld;
        $this->compareUrl = '#';
        $this->addToCartUrl = '#';
        $this->sellers = $product->sellers;
        $this->specifications = $product->specifications;
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
