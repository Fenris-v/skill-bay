<?php

namespace App\View\Components\Account;

use App\Models\Discount;
use App\Services\DiscountService;
use App\Repository\OrdersRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use \App\Models\Order as Model;

class Order extends Component
{
    public bool $isPaid;
    public ?string $payError = null;
    public float $priceOld;
    public float $price;
    public Collection $products;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public Model $order,
        OrdersRepository $orders,
        DiscountService $service
    ) {
        $this->isPaid = $orders->getPaymentStatus($this->order);

        if (!$this->isPaid) {
            $this->payError = $orders->getErrorMessage($this->order);
        }

        $products = $order->cart->products;
        $this->price = $service->getCartTotal($products);
        $this->priceOld = $order->cart->oldPrice;

        $discounts = $service->getCartDiscount($products);
        $this->products = $products->map(
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
                return $product;
            }
        );
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.account.order');
    }
}
