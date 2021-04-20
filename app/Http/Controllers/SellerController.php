<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Cache;

class SellerController extends Controller
{
    public function show(string $slug)
    {
        $seller = Cache::remember(
            'seller|show|' . $slug,
            86400,
            fn() => Seller::where('slug', $slug)->firstOrFail(),
        );

        return view('pages.main.seller', [
            'seller' => $seller,
            'breadcrumbs' => [
                ['title' => 'Главная', 'url' => '/'],
                ['title' => 'О продавце'],
            ],
        ]);
    }
}
