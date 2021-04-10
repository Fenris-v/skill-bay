{{--Табы--}}
@php
$tabs = [
    [
        'link' => '#description',
        'name' => 'Описание',
        'isActive' => true
    ],
    [
        'link' => '#sellers',
        'name' => 'Продавцы',
    ],
    [
        'link' => '#addit',
        'name' => 'AdditionaL Info',
    ],
    [
        'link' => '#reviews',
        'name' => 'Reviews (3)',
    ],
];
@endphp

<div class="Tabs Tabs_default">
    <div class="Tabs-links">
        @each('pages.product.tabs.tab_title', $tabs, 'tab')
    </div>

    <div class="Tabs-wrap">
        @include('pages.product.tabs.description')

        @include('pages.product.tabs.sellers')

        @include('pages.product.tabs.additional')

        @include('pages.product.tabs.reviews')
    </div>
</div>
