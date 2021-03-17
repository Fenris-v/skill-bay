<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('pages.main.index');
})->name('index');

Route::get('/about/', function () {
    return view('pages.about.index');
})->name('about');

Route::prefix('/account')->group(function () {
    Route::get('/', function () {
        return view('pages.account.index');
    })->name('account');

    Route::get('/orders/', function () {
        return view('pages.account.orders_history');
    })->name('account.orders');

    Route::get('/views/', function () {
        return view('pages.account.views_history');
    })->name('account.views');

    Route::get('/profile/', function () {
        return view('pages.account.profile');
    })->name('account.profile');

    Route::get('/orders/{id}/', function () {
        return view('pages.account.order_detail');
    })->name('account.orders.show');
});

Route::get('/catalog/', function () {
    return view('pages.catalog.categories');
})->name('catalog');

Route::get('/compare/', function () {
    return view('pages.catalog.compare');
})->name('compare');

Route::get('/product/', function () {
    return view('pages.product.index');
})->name('product');

Route::get('/contacts/', function () {
    return view('pages.contacts.index');
})->name('contacts');

Route::get('/sellers/', function () {
    return view('pages.seller.index');
})->name('seller');

Route::get('/discounts/', function () {
    return view('pages.discounts.index');
})->name('discounts');


Route::prefix('/order')->group(function () {
    Route::get('/cart/', function () {
        return view('pages.order.cart');
    })->name('cart');

    Route::get('/create/', function () {
        return view('pages.order.create');
    })->name('order.create');

    Route::get('/pay/', function () {
        return view('pages.payment.payment');
    })->name('order.pay');
});


