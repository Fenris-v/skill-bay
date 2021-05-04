<?php

use App\Http\Controllers\HistoryProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\OrderController;
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

Route::post('/product/{product}/add-to-cart', [ProductController::class, 'addToCart'])
    ->name('products.addToCart');
Route::post('/product/{product}/seller/{seller}/add-to-cart', [ProductController::class, 'addToCartWithSeller'])
    ->name('products.addToCartWithSeller');
Route::post('/product/{product}/add-to-compare', [ProductController::class, 'addToCompare'])
    ->name('products.addToCompare');

Route::get('/account/views', [HistoryProductController::class, 'index'])
    ->name('viewed_history')
    ->breadcrumbs(
        function (Trail $trail) {
            $trail->parent('index')
                ->push(__('navigation.history'), route('viewed_history'));
        }
    );

Route::get('/order/personal', [OrderController::class, 'stepPersonal'])
    ->name('order.personal')
    ->breadcrumbs(fn (Trail $trail) =>
    $trail
        ->parent('index')
        ->push(__('orderPage.title'), route('order.personal'))
    )
;

Route::get('/order/delivery', [OrderController::class, 'stepDelivery'])
    ->name('order.delivery')
    ->breadcrumbs(fn (Trail $trail) =>
    $trail
        ->parent('index')
        ->push(__('orderPage.title'), route('order.delivery'))
    )
;

Route::get('/order/payment', [OrderController::class, 'stepPayment'])
    ->name('order.payment')
    ->breadcrumbs(fn (Trail $trail) =>
    $trail
        ->parent('index')
        ->push(__('orderPage.title'), route('order.payment'))
    )
;

Route::get('/order/accept', [OrderController::class, 'stepAccept'])
    ->name('order.accept')
    ->breadcrumbs(fn (Trail $trail) =>
    $trail
        ->parent('index')
        ->push(__('orderPage.title'), route('order.accept'))
    )
;
