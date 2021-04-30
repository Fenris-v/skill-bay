<?php

namespace App\Http\Controllers;

use App\Repository\SellerRepository;
use Illuminate\Http\Request;
use App\Services\ProductCartService;
use App\Repository\ProductRepository;

class CartController extends Controller
{
    public function __construct(
        protected ProductCartService $productCartService,
        protected ProductRepository $productRepository
    ) {
        //
    }

    protected function getResultIndex(bool $result)
    {
        return $result ? 'success' : 'result';
    }

    public function show() {
        return view('pages.main.cart', [
            'products' => $this->productCartService->get(),
        ]);
    }

    public function removeProduct(
        string $slug
    ) {
        $result = $this->productCartService->remove($this->productRepository->getProductBySlug($slug));

        return back()
            ->withInput()
            ->with('message', __('cartMessages.productRemove.' . $this->getResultIndex($result)))
        ;
    }

    public function changeProductAmount(
        string $slug,
        Request $request
    ) {
        $amount = (int) $request->validate([
            'amount' => 'required|integer',
        ])['amount'];

        $result = $this->productCartService->changeAmount($this->productRepository->getProductBySlug($slug), $amount);

        return back()
            ->withInput()
            ->with('message', __('cartMessages.changeProductAmount.' . $this->getResultIndex($result)))
        ;
    }

    public function changeProductSeller(
        SellerRepository $sellerRepository,
        string $productSlug,
        Request $request
    ) {
        $sellerSlug = (string) $request->validate([
            'seller' => 'required|string',
        ])['seller'];

        $product = $this->productRepository->getProductBySlug($productSlug);
        $result = $this->productCartService->changeSeller(
            $product,
            $sellerRepository->getSellerBySlugFromProduct($product, $sellerSlug)
        );

        return back()
            ->withInput()
            ->with('message', __('cartMessages.changeProductSeller.' . $this->getResultIndex($result)))
        ;
    }
}
