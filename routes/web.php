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

Route::get('/seller/{seller}', 'App\Http\Controllers\SellerController@show')->name('seller');

Route::get('/product/{product}',
    fn() => view('pages.main.product', [
        'product' => \App\Models\Product::first(),
        'breadcrumbs' => [
            ['isCurrent' => false, 'title' => 'Главная', 'url' => '/'],
            ['isCurrent' => false, 'title' => 'Каталог', 'url' => '/catalog'],
            ['isCurrent' => false, 'title' => 'Ноутбуки', 'url' => '/catalog/notebooks'],
            ['isCurrent' => true, 'title' => 'Товар'],
        ],
    ])
)->name('product');
