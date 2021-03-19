{{--Слайдер с 2мя слайдами--}}
@php
    $popular = [
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
                'discount' => null
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
<div class="Slider Slider_carousel">
    @include('layouts.blocks.header_line', ['title' => 'Hot Offers', 'isSlider' => true])

    <div class="Slider-box Cards Cards_hz">
        @each('pages.main.slder_two_items_item', $popular, 'item')
    </div>
</div>
