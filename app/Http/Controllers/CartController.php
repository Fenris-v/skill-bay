<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Services\ProductCartService;

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
        string $slug
    ) {
        if ($productCartService->remove($slug)) {
            $message = __('cartMessages.productRemove.success');
        } else {
            $message = __('cartMessages.productRemove.error');
        }

        return back()->withInput()->with('message', $message);
    }

    public function changeProductAmount(
        ProductCartService $productCartService,
        string $slug,
        Request $request
    ) {
        if ($productCartService->changeAmount($slug, $request->only(['amount']))) {
            $message = __('cartMessages.changeProductAmount.success');
        } else {
            $message = __('cartMessages.changeProductAmount.error');
        }

        return back()->withInput()->with('message', $message);
    }

    public function changeProductSeller(
        ProductCartService $productCartService,
        string $productSlug,
        Request $request
    ) {
        if ($productCartService->changeSeller($productSlug, $request->only(['seller']))) {
            $message = __('cartMessages.changeProductSeller.success');
        } else {
            $message = __('cartMessages.changeProductSeller.error');
        }

        return back()->withInput()->with('message', $message);
    }
}
