{{--Основной шаблон главной страницы--}}
@extends('layouts.layout')

@section('title', 'Megano')

@section('meta_description', 'Описание страницы')

@section('content')
    <x-banners.banners />

    <div class="Middle">
        <div class="Section">
            <div class="wrap">
                <div class="BannersHome">
                    <a class="BannersHomeBlock" href="#">
                        <div class="BannersHomeBlock-row">
                            <div class="BannersHomeBlock-block">
                                <strong class="BannersHomeBlock-title">Video Cards</strong>
                                <div class="BannersHomeBlock-content">от&#32;<span class="BannersHomeBlock-price">$199.00</span></div>
                            </div>
                            <div class="BannersHomeBlock-block">
                                <div class="BannersHomeBlock-img"><img src="assets/img/content/home/videoca.png" alt="videoca.png"/></div>
                            </div>
                        </div>
                    </a>
                    <a class="BannersHomeBlock" href="#">
                        <div class="BannersHomeBlock-row">
                            <div class="BannersHomeBlock-block">
                                <strong class="BannersHomeBlock-title">Head Phones</strong>
                                <div class="BannersHomeBlock-content">от&#32;<span class="BannersHomeBlock-price">$210.00</span>
                                </div>
                            </div>
                            <div class="BannersHomeBlock-block">
                                <div class="BannersHomeBlock-img"><img src="assets/img/content/home/videoca.png" alt="videoca.png"/></div>
                            </div>
                        </div>
                    </a>
                    <a class="BannersHomeBlock" href="#">
                        <div class="BannersHomeBlock-row">
                            <div class="BannersHomeBlock-block">
                                <strong class="BannersHomeBlock-title">Bass Speakers</strong>
                                <div class="BannersHomeBlock-content">от&#32;<span class="BannersHomeBlock-price">$159.00</span></div>
                            </div>
                            <div class="BannersHomeBlock-block">
                                <div class="BannersHomeBlock-img"><img src="assets/img/content/home/videoca.png" alt="videoca.png"/></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="Section Section_column Section_columnLeft Section_columnDesktop">
            <div class="wrap">
                <x-daily-offer />
                <x-catalog.product-top />
            </div>
        </div>
        <div class="Section Section_dark">
            <div class="wrap">
                <div class="Section-content">
                    <div class="Slider Slider_carousel">
                        <header class="Section-header">
                            <h2 class="Section-title">Горячие предложения</h2>
                            <div class="Section-control">
                                <div class="Slider-navigate">
                                </div>
                            </div>
                        </header>
                        <div class="Slider-box Cards Cards_hz">
                            <div class="Slider-item">
                                <div class="Slider-content">
                                    <div class="Card"><a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                                        <div class="Card-content">
                                            <strong class="Card-title"><a href="#">Corsair Carbide Series Arctic White Steel</a>
                                            </strong>
                                            <div class="Card-description">
                                                <div class="Card-cost"><span class="Card-priceOld">$115.00</span><span class="Card-price">$85.00</span>
                                                </div>
                                                <div class="Card-category">Games / xbox
                                                </div>
                                                <div class="Card-hover"><a class="Card-btn" href="#"><img src="assets/img/icons/card/bookmark.svg" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/cart.svg" alt="cart.svg"/></a><a class="Card-btn" href="compare.html"><img src="assets/img/icons/card/change.svg" alt="change.svg"/></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="Card-sale">-60%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Slider-item">
                                <div class="Slider-content">
                                    <div class="Card"><a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                                        <div class="Card-content">
                                            <strong class="Card-title"><a href="#">Barand New Phone Smart Business</a>
                                            </strong>
                                            <div class="Card-description">
                                                <div class="Card-cost"><span class="Card-priceOld">$115.00</span><span class="Card-price">$85.00</span>
                                                </div>
                                                <div class="Card-category">Games / xbox
                                                </div>
                                                <div class="Card-hover"><a class="Card-btn" href="#"><img src="assets/img/icons/card/bookmark.svg" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/cart.svg" alt="cart.svg"/></a><a class="Card-btn" href="compare.html"><img src="assets/img/icons/card/change.svg" alt="change.svg"/></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="Card-sale">-60%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Slider-item">
                                <div class="Slider-content">
                                    <div class="Card"><a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                                        <div class="Card-content">
                                            <strong class="Card-title"><a href="#">Mavic PRO Mini Drones Hobby RC Quadcopter</a>
                                            </strong>
                                            <div class="Card-description">
                                                <div class="Card-cost"><span class="Card-priceOld">$115.00</span><span class="Card-price">$185.00</span>
                                                </div>
                                                <div class="Card-category">Digital / xbox
                                                </div>
                                                <div class="Card-hover"><a class="Card-btn" href="#"><img src="assets/img/icons/card/bookmark.svg" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/cart.svg" alt="cart.svg"/></a><a class="Card-btn" href="compare.html"><img src="assets/img/icons/card/change.svg" alt="change.svg"/></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="Card-sale">-60%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Slider-item">
                                <div class="Slider-content">
                                    <div class="Card"><a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                                        <div class="Card-content">
                                            <strong class="Card-title"><a href="#">Corsair Carbide Series Arctic White Steel</a>
                                            </strong>
                                            <div class="Card-description">
                                                <div class="Card-cost"><span class="Card-priceOld">$115.00</span><span class="Card-price">$85.00</span>
                                                </div>
                                                <div class="Card-category">Games / xbox
                                                </div>
                                                <div class="Card-hover"><a class="Card-btn" href="#"><img src="assets/img/icons/card/bookmark.svg" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/cart.svg" alt="cart.svg"/></a><a class="Card-btn" href="compare.html"><img src="assets/img/icons/card/change.svg" alt="change.svg"/></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="Card-sale">-60%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Slider-item">
                                <div class="Slider-content">
                                    <div class="Card"><a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                                        <div class="Card-content">
                                            <strong class="Card-title"><a href="#">Barand New Phone Smart Business</a>
                                            </strong>
                                            <div class="Card-description">
                                                <div class="Card-cost"><span class="Card-priceOld">$115.00</span><span class="Card-price">$85.00</span>
                                                </div>
                                                <div class="Card-category">Games / xbox
                                                </div>
                                                <div class="Card-hover"><a class="Card-btn" href="#"><img src="assets/img/icons/card/bookmark.svg" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/cart.svg" alt="cart.svg"/></a><a class="Card-btn" href="compare.html"><img src="assets/img/icons/card/change.svg" alt="change.svg"/></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="Card-sale">-60%
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Slider-item">
                                <div class="Slider-content">
                                    <div class="Card"><a class="Card-picture" href="#"><img src="assets/img/content/home/card.jpg" alt="card.jpg"/></a>
                                        <div class="Card-content">
                                            <strong class="Card-title"><a href="#">Mavic PRO Mini Drones Hobby RC Quadcopter</a>
                                            </strong>
                                            <div class="Card-description">
                                                <div class="Card-cost"><span class="Card-priceOld">$115.00</span><span class="Card-price">$185.00</span>
                                                </div>
                                                <div class="Card-category">Digital / xbox
                                                </div>
                                                <div class="Card-hover"><a class="Card-btn" href="#"><img src="assets/img/icons/card/bookmark.svg" alt="bookmark.svg"/></a><a class="Card-btn" href="#"><img src="assets/img/icons/card/cart.svg" alt="cart.svg"/></a><a class="Card-btn" href="compare.html"><img src="assets/img/icons/card/change.svg" alt="change.svg"/></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="Card-sale">-60%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="Section Section_column Section_columnRight">
            <div class="wrap">
                <x-aside.advantages />
                <div class="Section-content">
                    <x-limited-edition />
                </div>
            </div>
        </div>
    </div>
@endsection
