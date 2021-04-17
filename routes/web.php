<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/',
    function () {
        return view('pages.main.index');
    }
)
    ->name('index')
    ->breadcrumbs(fn (Trail $trail) =>
        $trail->push('Главная', route('index'))
    )
;

Route::get('/catalog/{slug?}', [ProductController::class, 'index'])
    ->name('products.index')
    ->breadcrumbs(fn (Trail $trail, $slug = null) =>
        $trail
            ->parent('index')
            ->push('Каталог', route('products.index', $slug))
    )
;

Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->name('products.show')
    ->breadcrumbs(fn (Trail $trail, $product) =>
        $trail
            ->parent('index')
            ->push('О товаре', route('products.show', $product))
    )
;

Route::get('/seller/{seller}', [SellerController::class, 'show'])
    ->name('seller')
    ->breadcrumbs(fn (Trail $trail, $seller) =>
        $trail
            ->parent('index')
            ->push('О продавце', route('seller', $seller))
    )
;
