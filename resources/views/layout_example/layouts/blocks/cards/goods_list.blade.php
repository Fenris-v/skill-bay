{{--Список товаров--}}
@php
    $popular = [
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

<div class="Cards">
    @foreach($popular as $item)
        @php($class = 'Card')

        @if($loop->index > 5)
            @php($class = 'Card hide_md hide_1450')
        @elseif($loop->index > 3)
            @php($class = 'Card hide_md')
        @endif

        @include('layouts.blocks.cards.card_item', ['item' => $item, 'class' => $class])
    @endforeach
</div>
