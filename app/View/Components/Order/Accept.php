<?php

namespace App\View\Components\Order;

use App\Models\Discount;
use App\Repository\OrdersRepository;
use App\Services\DiscountService;
use App\Services\ProductCartService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use App\Models\Order;

class Accept extends Component
{
    public Order $order;
    public Collection $products;

    public function __construct(
        OrdersRepository $ordersRepository,
        ProductCartService $productCartService,
        DiscountService $service
    ) {
        $this->order = $ordersRepository->getCurrentOrder();
        $this->products = $productCartService->get();
        $discounts = $service->getCartDiscount($this->products);
        $this->products->map(
            function($product) use ($discounts, $service) {
                $product->priceOld = $product->price;
                $discount = $discounts->get($product->slug);
                if ($discount?->type === Discount::PRODUCT) {
                    $product->price = $service->calculateDiscountPrice(
                        $product,
                        $discount,
                        $product->price
                    );
                }
            }
        );
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order.accept');
    }
}
