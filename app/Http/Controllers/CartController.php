<?php

namespace App\Http\Controllers;

use App\Repository\SellerRepository;
use Illuminate\Http\Request;
use App\Services\ProductCartService;
use App\Repository\ProductRepository;
use App\Services\AlertFlashService;
use App\Services\DiscountService;
use Illuminate\Contracts\View\View;

class CartController extends Controller
{
    public function __construct(
        protected ProductCartService $productCartService,
        protected ProductRepository $productRepository,
        protected AlertFlashService $alert
    ) {
        //
    }

    protected function getResultIndex(bool $result)
    {
        if (!$result) {
            $this->alert->danger();
        }

        return $result ? 'success' : 'error';
    }

    /**
     * @param DiscountService $discountService
     * @return View
     */
    public function show(DiscountService $discountService): View
    {
        $products = $this->productCartService->get();

        $discounts = $discountService->getCartDiscount($products);

        return view('pages.main.cart', compact('products', 'discounts'));
    }

    public function removeProduct(
        string $slug
    ) {
        $result = $this->productCartService->remove($this->productRepository->getProductBySlug($slug));

        $this->alert->lang('cartMessages.productRemove.' . $this->getResultIndex($result));

        if ($result) {
            $this->alert->warning();
        }

        return back();
    }

    public function changeProductAmount(
        string $slug,
        Request $request
    ) {
        $amount = (int)$request->validate(
            [
                'amount' => 'required|integer',
            ]
        )['amount'];

        $result = $this->productCartService->changeAmount($this->productRepository->getProductBySlug($slug), $amount);

        $this->alert->lang('cartMessages.changeProductAmount.' . $this->getResultIndex($result));

        return back();
    }

    public function changeProductSeller(
        SellerRepository $sellerRepository,
        string $productSlug,
        Request $request
    ) {
        $sellerSlug = (string)$request->validate(
            [
                'seller' => 'required|string',
            ]
        )['seller'];

        $product = $this->productRepository->getProductBySlug($productSlug);
        $result = $this->productCartService->changeSeller(
            $product,
            $sellerRepository->getSellerBySlugFromProduct($product, $sellerSlug)
        );

        $this->alert->lang('cartMessages.changeProductSeller.' . $this->getResultIndex($result));

        return back();
    }
}
