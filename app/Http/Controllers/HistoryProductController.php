<?php

namespace App\Http\Controllers;

use App\Services\ProductViewHistoryService;

class HistoryProductController extends Controller
{
    public function index(ProductViewHistoryService $history)
    {
        $products = $history->get();

        return view('pages.account.history', compact('products'));
    }
}
