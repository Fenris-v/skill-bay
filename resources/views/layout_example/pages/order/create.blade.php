{{--Оформление заказа--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'Оформление заказа',
        ],
    ];
@endphp

@extends('layouts.layout')

@section('title', 'Оформление заказа')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'Оформление заказа', 'breadcrumbs' => $breadcrumbs])

    <div class="Section Section_column Section_columnRight Section_columnWide Order">
        <div class="wrap">
            <div class="Section-column">
                <div class="Section-columnSection">
                    @include('layouts.blocks.header_line', ['title' => 'Прогресс заполнения'])

                    <div class="Section-columnContent">
                        <ul class="menu menu_vt Order-navigate">
                            <li class="menu-item_ACTIVE menu-item">
                                <a class="menu-link" href="#step1">Шаг 1. Параметры пользователя</a>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link" href="#step2">Шаг 2. Способ доставки</a>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link" href="#step3">Шаг 3. Способ оплаты</a>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link" href="#step4">Шаг 4. Подтверждение заказа</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="Section-content">
                <form class="form" action="#" method="post">
                    <div class="Order-block Order-block_OPEN" id="step1">
                        @include('layouts.blocks.header_line', ['title' => 'Шаг 1. Параметры пользователя', 'class' => 'Section-header Section-header_sm'])

                        @include('pages.order.info.personal')

                        @include('pages.order.info.order_footer', ['index' => 2])
                    </div>

                    <div class="Order-block" id="step2">
                        @include('layouts.blocks.header_line', ['title' => 'Шаг 2. Способ доставки', 'class' => 'Section-header Section-header_sm'])

                        @include('pages.order.info.delivery')

                        @include('pages.order.info.order_footer', ['index' => 3])
                    </div>

                    <div class="Order-block" id="step3">
                        @include('layouts.blocks.header_line', ['title' => 'Шаг 3. Способ оплаты', 'class' => 'Section-header Section-header_sm'])

                        @include('pages.order.info.payment')

                        @include('pages.order.info.order_footer', ['index' => 4])
                    </div>
                    <div class="Order-block" id="step4">
                        @include('layouts.blocks.header_line', ['title' => 'Шаг 4. Подтверждение заказа', 'class' => 'Section-header Section-header_sm'])

                        <!--+div.Order.-confirmation-->
                        <div class="Order-infoBlock">
                            @include('pages.order.info.accept')

                            <div class="Cart Cart_order">

                                <div class="Cart-product">
                                    <div class="Cart-block Cart-block_row">
                                        <div class="Cart-block Cart-block_pict"><a class="Cart-pict" href="#"><img class="Cart-img" src="/assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                                        </div>
                                        <div class="Cart-block Cart-block_info"><a class="Cart-title" href="#">Ноутбук</a>
                                            <div class="Cart-desc">Это супер ноутбук, 3 гб. 4 ядра
                                            </div>
                                        </div>
                                        <div class="Cart-block Cart-block_price">
                                            <div class="Cart-price">80.00$
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Cart-block Cart-block_row">
                                        <div class="Cart-block Cart-block_seller">
                                            <div>Продавец:
                                            </div>
                                            <div>shop good
                                            </div>
                                        </div>
                                        <div class="Cart-block Cart-block_amount">1 шт.
                                        </div>
                                    </div>
                                </div>
                                <div class="Cart-product">
                                    <div class="Cart-block Cart-block_row">
                                        <div class="Cart-block Cart-block_pict"><a class="Cart-pict" href="#"><img class="Cart-img" src="/assets/img/content/sale/product.png" alt="product.png"/></a>
                                        </div>
                                        <div class="Cart-block Cart-block_info"><a class="Cart-title" href="#">Планшет</a>
                                            <div class="Cart-desc">Это планшет с современным железом. Процессор последнего поколения
                                            </div>
                                        </div>
                                        <div class="Cart-block Cart-block_price">
                                            <div class="Cart-price_old">60.99$
                                            </div>
                                            <div class="Cart-price">40.99$
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Cart-block Cart-block_row">
                                        <div class="Cart-block Cart-block_seller">
                                            <div>Продавец:
                                            </div>
                                            <div>shop kke ываыва ыа ываыв а
                                            </div>
                                        </div>
                                        <div class="Cart-block Cart-block_amount">1 шт.
                                        </div>
                                    </div>
                                </div>
                                <div class="Cart-product">
                                    <div class="Cart-block Cart-block_row">
                                        <div class="Cart-block Cart-block_pict"><a class="Cart-pict" href="#"><img class="Cart-img" src="/assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                                        </div>
                                        <div class="Cart-block Cart-block_info"><a class="Cart-title" href="#">Ноутбук</a>
                                            <div class="Cart-desc">Это супер ноутбук, 3 гб. 4 ядра
                                            </div>
                                        </div>
                                        <div class="Cart-block Cart-block_price">
                                            <div class="Cart-price">80.00$
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Cart-block Cart-block_row">
                                        <div class="Cart-block Cart-block_seller">
                                            <div>Продавец:
                                            </div>
                                            <div>shop good
                                            </div>
                                        </div>
                                        <div class="Cart-block Cart-block_amount">1 шт.
                                        </div>
                                    </div>
                                </div>

                                <div class="Cart-total">
                                    @include('pages.order.items.cart_total_price')

                                    <div class="Cart-block">
                                        <button class="btn btn_primary btn_lg" type="submit">Оплатить
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
