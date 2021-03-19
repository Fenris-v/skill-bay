{{--Продавец--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'Seller',
        ],
    ];

    $follows = [
        [
            'img' => '/assets/img/icons/socialContent/fb.png',
            'alt' => 'fb.png',
        ],
        [
            'img' => '/assets/img/icons/socialContent/tw.png',
            'alt' => 'tw.png',
        ],
        [
            'img' => '/assets/img/icons/socialContent/gg.png',
            'alt' => 'gg.png',
        ],
        [
            'img' => '/assets/img/icons/socialContent/in.png',
            'alt' => 'in.png',
        ],
        [
            'img' => '/assets/img/icons/socialContent/pt.png',
            'alt' => 'pt.png',
        ],
        [
            'img' => '/assets/img/icons/socialContent/ml.png',
            'alt' => 'ml.png',
        ],
    ];

    $items = [
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => '/assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => '/assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => '/assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => '/assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => '/assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => '/assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => '/assets/img/content/home/card.jpg',
                'alt' => 'card.jpg',
                'oldPrice' => 115.00,
                'price' => 85.00,
                'category' => 'News / xbox',
                'link' => '#',
                'discount' => '-60%'
            ],
            [
                'name' => 'Corsair Carbide Series Arctic White Steel',
                'image' => '/assets/img/content/home/card.jpg',
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

@section('title', 'Seller')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'Seller', 'breadcrumbs' => $breadcrumbs])

    <div class="Section Section_column Section_columnLeft Section_columnWide">
        <div class="wrap">
            @include('layouts.blocks.advantages', ['follows' => $follows])

            <div class="Section-content">
                @include('pages.seller.description')

                @include('layouts.blocks.header_line', ['title' => 'Popular Products'])

                <div class="Cards">
                    @foreach($items as $item)
                        @php($class = 'Card')

                        @if($loop->index > 5)
                            @php($class = 'Card hide_md hide_1450')
                        @elseif($loop->index > 3)
                            @php($class = 'Card hide_md')
                        @endif

                        @include('layouts.blocks.cards.card_item', ['item' => $item])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
