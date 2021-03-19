{{--Выпадающее меню с категориями--}}
@php
    $menu = [
     [
        'name' => 'Accessories',
        'link' => route('catalog'),
        'icon' => '/assets/img/icons/departments/1.svg',
        'alt' => '1.svg'
    ],
    [
        'name' => 'Bags',
        'link' => route('catalog'),
        'icon' => '/assets/img/icons/departments/2.svg',
        'alt' => '2.svg'
    ],
    [
        'name' => 'Cameras',
        'link' => route('catalog'),
        'icon' => '/assets/img/icons/departments/3.svg',
        'alt' => '3.svg',
        'submenu' => [
            [
                'name' => 'Accessories',
                'link' => route('catalog'),
                'icon' => '/assets/img/icons/departments/1.svg',
                'alt' => '1.svg',
            ],
            [
                'name' => 'Bags',
                'link' => route('catalog'),
                'icon' => '/assets/img/icons/departments/2.svg',
                'alt' => '2.svg',
            ]
        ]
    ],
    [
        'name' => 'Clothings',
        'link' => route('catalog'),
        'icon' => '/assets/img/icons/departments/4.svg',
        'alt' => '4.svg'
    ],
    [
        'name' => 'Electronics',
        'link' => route('catalog'),
        'icon' => '/assets/img/icons/departments/5.svg',
        'alt' => '5.svg'
    ],
    [
        'name' => 'Fashion',
        'link' => route('catalog'),
        'icon' => '/assets/img/icons/departments/6.svg',
        'alt' => '6.svg'
    ],
    [
        'name' => 'Furniture',
        'link' => route('catalog'),
        'icon' => '/assets/img/icons/departments/7.svg',
        'alt' => '7.svg',
        'submenu' => [
            [
                'name' => 'Accessories',
                'link' => route('catalog'),
                'icon' => '/assets/img/icons/departments/1.svg',
                'alt' => '1.svg',
            ],
            [
                'name' => 'Bags',
                'link' => route('catalog'),
                'icon' => '/assets/img/icons/departments/2.svg',
                'alt' => '2.svg',
            ]
        ]
    ],
    [
        'name' => 'Lightings',
        'link' => route('catalog'),
        'icon' => '/assets/img/icons/departments/8.svg',
        'alt' => '8.svg'
    ],
    [
        'name' => 'Mobiles',
        'link' => route('catalog'),
        'icon' => '/assets/img/icons/departments/9.svg',
        'alt' => '9.svg'
    ],
    [
        'name' => 'Trends',
        'link' => route('catalog'),
        'icon' => '/assets/img/icons/departments/10.svg',
        'alt' => '10.svg'
    ],
    [
        'name' => 'More',
        'link' => route('catalog'),
        'icon' => '/assets/img/icons/departments/11.svg',
        'alt' => '11.svg',
        'submenu' => [
            [
                'name' => 'Accessories',
                'link' => route('catalog'),
                'icon' => '/assets/img/icons/departments/1.svg',
                'alt' => '1.svg',
            ],
            [
                'name' => 'Bags',
                'link' => route('catalog'),
                'icon' => '/assets/img/icons/departments/2.svg',
                'alt' => '2.svg',
            ]
        ]
    ],
    [
        'name' => 'Lightings2',
        'link' => route('catalog'),
        'icon' => '/assets/img/icons/departments/12.svg',
        'alt' => '12.svg'
    ],
];
@endphp

<div class="CategoriesButton-content">
    @each('layouts.header.dropdown_item', $menu, 'item')
</div>
