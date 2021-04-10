{{--Каталог--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'Catalog',
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

@section('title', 'Catalog')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'Catalog', 'breadcrumbs' => $breadcrumbs])

    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            <div class="Section-column">
                <div class="Section-columnSection">
                    @include('layouts.blocks.header_aside', ['title' => 'Filter'])

                    <div class="Section-columnContent">
                        @include('pages.catalog.filters.index')
                    </div>
                </div>
                <div class="Section-columnSection">
                    @include('layouts.blocks.header_aside', ['title' => 'Popular tags'])

                    <div class="Section-columnContent">
                        @include('pages.catalog.tags.cloud')
                    </div>
                </div>
            </div>

            <div class="Section-content">
                @include('pages.catalog.sort.index')

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

                @include('layouts.blocks.pagination')
            </div>
        </div>
    </div>
@endsection
