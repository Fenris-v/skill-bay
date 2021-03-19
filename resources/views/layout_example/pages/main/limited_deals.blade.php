{{--Ограниченные предложения--}}
@php
$deals = [
    [
        'name' => 'Corsair Carbide Series Arctic White Steel',
        'image' => 'assets/img/content/home/card.jpg',
        'alt' => 'card.jpg',
        'oldPrice' => '115.00',
        'price' => '85.00',
        'category' => 'News / xbox',
        'limitedEnd' => '31.09.2020 03:59',
        'link' => '#'
    ],
    [
        'name' => 'Corsair Carbide Series Arctic White Steel',
        'image' => 'assets/img/content/home/card.jpg',
        'alt' => 'card.jpg',
        'oldPrice' => '115.00',
        'price' => '85.00',
        'category' => 'News / xbox',
        'limitedEnd' => '31.09.2020 03:59',
        'link' => '#'
    ],
];
@endphp

<div class="Section-column">
    <div class="Section-columnSection Section-columnSection_mark">
        @include('layouts.blocks.section_header', ['title' => 'Limited Deals'])

        @each('layouts.blocks.cards.card_timer', $deals, 'item')
    </div>
</div>
