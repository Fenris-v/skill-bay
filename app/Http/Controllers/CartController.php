<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Repository\SellerRepository;
use Illuminate\Http\Request;
use App\Services\ProductCartService;
use App\Repository\ProductRepository;

class CartController extends Controller
{
    public function show(
        ProductCartService $productCartService
    ) {
        return view('pages.main.cart', [
            'products' => $productCartService->get(),
        ]);
    }

    public function removeProduct(
        ProductCartService $productCartService,
        ProductRepository $productRepository,
        string $slug
    ) {
        if ($productCartService->remove($productRepository->getProductBySlug($slug))) {
            $message = __('cartMessages.productRemove.success');
        } else {
            $message = __('cartMessages.productRemove.error');
        }

        return back()->withInput()->with('message', $message);
    }

    public function changeProductAmount(
        ProductCartService $productCartService,
        ProductRepository $productRepository,
        string $slug,
        Request $request
    ) {
        $amount = (int) $request->validate([
            'amount' => 'required|integer',
        ])['amount'];

        if ($productCartService->changeAmount($productRepository->getProductBySlug($slug), $amount)) {
            $message = __('cartMessages.changeProductAmount.success');
        } else {
            $message = __('cartMessages.changeProductAmount.error');
        }

        return back()->withInput()->with('message', $message);
    }

    public function changeProductSeller(
        ProductCartService $productCartService,
        ProductRepository $productRepository,
        SellerRepository $sellerRepository,
        string $productSlug,
        Request $request
    ) {
        $sellerSlug = (string) $request->validate([
            'seller' => 'required|string',
        ])['seller'];

        $product = $productRepository->getProductBySlug($productSlug);
        if ($productCartService->changeSeller(
            $product,
            $sellerRepository->getSellerBySlugFromProduct($product, $sellerSlug))
        ) {
            $message = __('cartMessages.changeProductSeller.success');
        } else {
            $message = __('cartMessages.changeProductSeller.error');
        }

        return back()->withInput()->with('message', $message);
    }
}
