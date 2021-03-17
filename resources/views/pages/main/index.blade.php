{{--Основной шаблон главной страницы--}}

@php
    $topBanners = [
        [
            'name' => 'Mavic Pro<span class="text_primary"> 5</span> mini Drone',
            'description' => 'Get the best phoneyou ever seen with modern Windows OS plus 70% Off this summer.',
            'link' => '#',
            'link_text' => 'Get Started',
            'img' => '/assets/img/content/home/slider.png',
            'alt' => 'slider.png',
        ],
        [
            'name' => 'Mavic Pro<span class="text_primary"> 5</span> mini Drone',
            'description' => 'Get the best phoneyou ever seen with modern Windows OS plus 70% Off this summer.',
            'link' => '#',
            'link_text' => 'Get Started',
            'img' => '/assets/img/content/home/slider.png',
            'alt' => 'slider.png',
        ],
        [
            'name' => 'Mavic Pro<span class="text_primary"> 5</span> mini Drone',
            'description' => 'Get the best phoneyou ever seen with modern Windows OS plus 70% Off this summer.',
            'link' => '#',
            'link_text' => 'Get Started',
            'img' => '/assets/img/content/home/slider.png',
            'alt' => 'slider.png',
        ],
    ];

    $banners = [
        [
            'name' => 'Video Cards',
            'description' => 'from&#32;<span class="BannersHomeBlock-price">$199.00',
            'link' => '#',
            'link_text' => null,
            'img' => 'assets/img/content/home/videoca.png',
            'alt' => 'videoca.png',
        ],
        [
            'name' => 'Head Phones',
            'description' => 'from&#32;<span class="BannersHomeBlock-price">$210.00',
            'link' => '#',
            'link_text' => null,
            'img' => 'assets/img/content/home/videoca.png',
            'alt' => 'videoca.png',
        ],
        [
            'name' => 'Bass Speakers',
            'description' => 'from&#32;<span class="BannersHomeBlock-price">$159.00',
            'link' => '#',
            'link_text' => null,
            'img' => 'assets/img/content/home/videoca.png',
            'alt' => 'videoca.png',
        ],
    ];

    $items = [
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => 'assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => 'assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => 'assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => 'assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => 'assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => 'assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => 'assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => 'assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
        ];
@endphp

@extends('layouts.layout')

@section('title', 'Megano')

@section('meta_description', 'Описание страницы')

@section('content')
    @include('pages.main.top_slider', ['banners' => $topBanners])

    <div class="Section">
        <div class="wrap">
            @include('pages.main.banners', ['banners' => $banners])
        </div>
    </div>
    <div class="Section Section_column Section_columnLeft Section_columnDesktop">
        <div class="wrap">
            @include('pages.main.limited_deals')

            <div class="Section-content">
                @include('layouts.blocks.header_line', ['title' => 'Popular Products'])

                @include('layouts.blocks.cards.goods_list')
            </div>
        </div>
    </div>

    <div class="Section Section_dark">
        <div class="wrap">
            <div class="Section-content">
                @include('pages.main.slider_two_items')
            </div>
        </div>
    </div>

    <div class="Section Section_column Section_columnRight">
        <div class="wrap">
            @include('layouts.blocks.advantages')

            <div class="Section-content">
                <div class="Slider Slider_carousel">
                    @include('layouts.blocks.header_line', ['title' => 'Limited edition', 'isSlider' => true])
                    <div class="Slider-box Cards">
                        @foreach($items as $item)
                            <div class="Slider-item">
                                <div class="Slider-content">
                                    @include('layouts.blocks.cards.card_item', ['item' => $item])
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
