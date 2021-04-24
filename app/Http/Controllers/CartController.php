<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Services\ProductCartService;

class CartController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(
        ProductCartService $productCartService
    ) {
        return view('pages.main.cart', [
            'products' => $productCartService->get(),
        ]);
    }
}
