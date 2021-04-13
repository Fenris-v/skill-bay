<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Services\AdminSettingsService;

class SellerController extends Controller
{
    public function show(Seller $seller)
    {
        return view('pages.main.seller', [
            'seller' => $seller,
            'breadcrumbs' => [
                ['isCurrent' => false, 'title' => 'Главная', 'url' => '/'],
                ['isCurrent' => true, 'title' => 'О продавце'],
            ],
        ]);
    }
}
