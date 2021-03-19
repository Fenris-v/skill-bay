{{--Личный кабинет - детальный просмотр заказа--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'История заказов',
            'link' => route('account.orders'),
        ],
        [
            'name' => 'Заказ №200',
        ],
    ];

    $items = [
        [
            'name' => 'Ноутбук',
            'img' => '/assets/img/content/home/card.jpg',
            'alt' => 'card.jpg',
            'link' => '#',
            'price' => '80.00',
            'seller' => 'shop good',
            'amount' => '1',
            'description' => 'Это супер ноутбук, 3 гб. 4 ядра',
        ],
        [
            'name' => 'Ноутбук',
            'img' => '/assets/img/content/sale/product.png',
            'alt' => 'product.png',
            'link' => '#',
            'price' => '80.00',
            'oldPrice' => '90.00',
            'seller' => 'shop good',
            'amount' => '1',
            'description' => 'Это планшет с современным железом. Процессор последнего поколения',
        ],
        [
            'name' => 'Ноутбук',
            'img' => '/assets/img/content/home/card.jpg',
            'alt' => 'card.jpg',
            'link' => '#',
            'price' => '80.00',
            'oldPrice' => '90.00',
            'seller' => 'shop good',
            'amount' => '1',
            'description' => 'Это супер ноутбук, 3 гб. 4 ядра',
        ],
    ];
@endphp

@extends('layouts.layout')

@section('title', 'Order detail')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'Заказ №200', 'breadcrumbs' => $breadcrumbs])

    <div class="Section">
        <div class="wrap">
            <div class="Section-content">
                <div class="Orders"></div>
                <div class="Order">
                    <div class="Order-infoBlock">
                        @include('pages.account.blocks.orders.order_personal')

                        <div class="Cart Cart_order">
                            @each('pages.account.blocks.cart_item', $items, 'item')

                            @include('pages.account.blocks.cart_total')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
