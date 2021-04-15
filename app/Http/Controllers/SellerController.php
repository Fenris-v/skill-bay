<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Cache;
use App\Repository\ConfigRepository;

class SellerController extends Controller
{
    public function show(string $slug, ConfigRepository $configs)
    {
        $seller = Cache::tags(
            [ConfigRepository::GLOBAL_CACHE_TAG, Seller::class]
        )->remember(
            'seller|show|' . $slug,
            $configs->getCacheLifetime(),
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
