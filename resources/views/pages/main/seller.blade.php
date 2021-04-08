{{--Шаблон продавца--}}
@extends('layouts.layout')

@section('title', 'Megano')

@section('meta_description', 'Сведения о продавце')

@php
    // Для дальнейшего удаления
    $seller = \App\Models\Seller::find(1);
    $breadcrumbs = [
        ['isCurrent' => false, 'title' => 'Главная'],
        ['isCurrent' => true, 'title' => 'О продавце'],
    ];
@endphp

@section('content')
    <div class="Middle Middle_top">
        <div class="Middle-top">
            <div class="wrap">
                <div class="Middle-header">
                    <h1 class="Middle-title">Продавец {{ $seller->title }}</h1>
                    <x-wrappers.breadcrumbs
                        :items="$breadcrumbs"
                    />
                </div>
            </div>
        </div>
        <div class="Section Section_column Section_columnLeft Section_columnWide">
            <div class="wrap">
                <x-seller :seller="$seller">
                    {{--Для дальнейшего редактирования--}}
                    <header class="Section-header">
                        <h2 class="Section-title">Популярные товары продавца</h2>
                    </header>
                    <div class="Cards">
                        <div class="Card"><a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                            <div class="Card-content">
                                <strong class="Card-title"><a href="#">Corsair Carbide Series Arctic White Steel</a>
                                </strong>
                                <div class="Card-description">
                                    <div class="Card-cost"><span class="Card-priceOld">$115.00</span><span class="Card-price">$85.00</span>
                                    </div>
                                    <div class="Card-category">Games / xbox
                                    </div>
                                    <div class="Card-hover"><a class="Card-btn" href="#"><img src="assets/img/icons/card/bookmark.svg" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/cart.svg" alt="cart.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/change.svg" alt="change.svg"/></a>
                                    </div>
                                </div>
                            </div>
                            <div class="Card-sale">-60%
                            </div>
                        </div>
                        <div class="Card"><a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                            <div class="Card-content">
                                <strong class="Card-title"><a href="#">Barand New Phone Smart Business</a>
                                </strong>
                                <div class="Card-description">
                                    <div class="Card-cost"><span class="Card-priceOld">$115.00</span><span class="Card-price">$85.00</span>
                                    </div>
                                    <div class="Card-category">Games / xbox
                                    </div>
                                    <div class="Card-hover"><a class="Card-btn" href="#"><img src="assets/img/icons/card/bookmark.svg" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/cart.svg" alt="cart.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/change.svg" alt="change.svg"/></a>
                                    </div>
                                </div>
                            </div>
                            <div class="Card-sale">-60%
                            </div>
                        </div>
                        <div class="Card"><a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                            <div class="Card-content">
                                <strong class="Card-title"><a href="#">Mavic PRO Mini Drones Hobby RC Quadcopter</a>
                                </strong>
                                <div class="Card-description">
                                    <div class="Card-cost"><span class="Card-priceOld">$115.00</span><span class="Card-price">$185.00</span>
                                    </div>
                                    <div class="Card-category">Digital / xbox
                                    </div>
                                    <div class="Card-hover"><a class="Card-btn" href="#"><img src="assets/img/icons/card/bookmark.svg" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/cart.svg" alt="cart.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/change.svg" alt="change.svg"/></a>
                                    </div>
                                </div>
                            </div>
                            <div class="Card-sale">-60%
                            </div>
                        </div>
                        <div class="Card"><a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                            <div class="Card-content">
                                <strong class="Card-title"><a href="#">Corsair Carbide Series Arctic White Steel</a>
                                </strong>
                                <div class="Card-description">
                                    <div class="Card-cost"><span class="Card-price">$210.00</span>
                                    </div>
                                    <div class="Card-category">Media / xbox
                                    </div>
                                    <div class="Card-hover"><a class="Card-btn" href="#"><img src="assets/img/icons/card/bookmark.svg" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/cart.svg" alt="cart.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/change.svg" alt="change.svg"/></a>
                                    </div>
                                </div>
                            </div>
                            <div class="Card-sale">-60%
                            </div>
                        </div>
                        <div class="Card"><a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                            <div class="Card-content">
                                <strong class="Card-title"><a href="#">Corsair Carbide Series Arctic White Steel</a>
                                </strong>
                                <div class="Card-description">
                                    <div class="Card-cost"><span class="Card-priceOld">$115.00</span><span class="Card-price">$85.00</span>
                                    </div>
                                    <div class="Card-category">Games / xbox
                                    </div>
                                    <div class="Card-hover"><a class="Card-btn" href="#"><img src="assets/img/icons/card/bookmark.svg" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/cart.svg" alt="cart.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/change.svg" alt="change.svg"/></a>
                                    </div>
                                </div>
                            </div>
                            <div class="Card-sale">-60%
                            </div>
                        </div>
                        <div class="Card"><a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                            <div class="Card-content">
                                <strong class="Card-title"><a href="#">Barand New Phone Smart Business</a>
                                </strong>
                                <div class="Card-description">
                                    <div class="Card-cost"><span class="Card-priceOld">$115.00</span><span class="Card-price">$85.00</span>
                                    </div>
                                    <div class="Card-category">Games / xbox
                                    </div>
                                    <div class="Card-hover"><a class="Card-btn" href="#"><img src="assets/img/icons/card/bookmark.svg" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/cart.svg" alt="cart.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/change.svg" alt="change.svg"/></a>
                                    </div>
                                </div>
                            </div>
                            <div class="Card-sale">-60%
                            </div>
                        </div>
                        <div class="Card hide_md hide_1450"><a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                            <div class="Card-content">
                                <strong class="Card-title"><a href="#">Mavic PRO Mini Drones Hobby RC Quadcopter</a>
                                </strong>
                                <div class="Card-description">
                                    <div class="Card-cost"><span class="Card-priceOld">$115.00</span><span class="Card-price">$185.00</span>
                                    </div>
                                    <div class="Card-category">Digital / xbox
                                    </div>
                                    <div class="Card-hover"><a class="Card-btn" href="#"><img src="assets/img/icons/card/bookmark.svg" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/cart.svg" alt="cart.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/change.svg" alt="change.svg"/></a>
                                    </div>
                                </div>
                            </div>
                            <div class="Card-sale">-60%
                            </div>
                        </div>
                        <div class="Card hide_md hide_1450"><a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                            <div class="Card-content">
                                <strong class="Card-title"><a href="#">Corsair Carbide Series Arctic White Steel</a>
                                </strong>
                                <div class="Card-description">
                                    <div class="Card-cost"><span class="Card-price">$210.00</span>
                                    </div>
                                    <div class="Card-category">Media / xbox
                                    </div>
                                    <div class="Card-hover"><a class="Card-btn" href="#"><img src="assets/img/icons/card/bookmark.svg" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/cart.svg" alt="cart.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/change.svg" alt="change.svg"/></a>
                                    </div>
                                </div>
                            </div>
                            <div class="Card-sale">-60%
                            </div>
                        </div>
                    </div>
                </x-seller>
            </div>
        </div>
    </div>
@endsection
