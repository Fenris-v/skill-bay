{{--Список социальных сетей--}}
@php
    $socials = [
        [
            'icon' => 'fb.svg',
            'alt' => 'fb.svg',
            'link' => '#',
        ],
        [
            'icon' => 'tw.svg',
            'alt' => 'tw.svg',
            'link' => '#',
        ],
        [
            'icon' => 'in.svg',
            'alt' => 'in.svg',
            'link' => '#',
        ],
        [
            'icon' => 'pt.svg',
            'alt' => 'pt.svg',
            'link' => '#',
        ],
        [
            'icon' => 'mail.svg',
            'alt' => 'mail.svg',
            'link' => '#',
        ],
    ];
@endphp

<ul class="menu menu_img menu_smallImg {{ isset($isFooter) ? 'Footer-menuSoc' : 'ControlPanel-menu' }}">
    @each('layouts.blocks.socials.social_item', $socials, 'item')
</ul>
