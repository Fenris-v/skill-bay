{{--Корзина--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'Корзина',
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

@section('title', 'Корзина')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'Корзина', 'breadcrumbs' => $breadcrumbs])

        <div class="Section">
            <div class="wrap">
                <form class="form Cart" action="#" method="post">
                    @each('pages.order.items.cart', $items, 'item')

                    <div class="Cart-total">
                        @include('pages.order.items.cart_total_price')

                        <div class="Cart-block">
                            <a class="btn btn_success btn_lg" href="{{ route('order.create') }}">Оформить заказ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
