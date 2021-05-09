<?php

use App\Http\Controllers\HistoryProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CompareProductController;
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
        $trail->push(__('navigation.main'), route('index'))
    )
;

Route::get('/catalog/{slug?}', [ProductController::class, 'index'])
    ->name('products.index')
    ->breadcrumbs(fn (Trail $trail, $slug = null) =>
        $trail
            ->parent('index')
            ->push(__('navigation.catalog'), route('products.index', $slug))
    )
;

Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('products.show')
    ->breadcrumbs(fn (Trail $trail, $product) =>
        $trail
            ->parent('index')
            ->push(__('navigation.product'), route('products.show', $product))
    )
;

Route::get('/sellers/{seller}', [SellerController::class, 'show'])
    ->name('sellers')
    ->breadcrumbs(fn (Trail $trail, $seller) =>
        $trail
            ->parent('index')
            ->push(__('navigation.seller'), route('sellers', $seller))
    )
;

Route::get('/compare', [ProductController::class, 'compare'])
    ->name('compare')
    ->breadcrumbs(fn (Trail $trail) =>
    $trail
        ->parent('index')
        ->push(__('navigation.compare'), route('compare'))
    )
;

Route::post('/product/{product}/add-to-cart', [ProductController::class, 'addToCart'])
    ->name('products.addToCart');
Route::post('/product/{product}/seller/{seller}/add-to-cart', [ProductController::class, 'addToCartWithSeller'])
    ->name('products.addToCartWithSeller');
Route::post('/product/{product}/add-to-compare', [ProductController::class, 'addToCompare'])
    ->name('products.addToCompare');
Route::post('/product/{product}/remove-from-compare', [ProductController::class, 'removeFromCompare'])
    ->name('products.removeFromCompare');

Route::get('/account/views', [HistoryProductController::class, 'index'])
    ->name('viewed_history')
    ->breadcrumbs(
        function (Trail $trail) {
            $trail->parent('index')
                ->push(__('navigation.history'), route('viewed_history'));
        }
    );
