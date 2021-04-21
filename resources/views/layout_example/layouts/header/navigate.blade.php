{{--Меню навигации в хэдере--}}
@php
    $menu = [
        'Home' => [
            'page' => route('index')
        ],
        'Shop' => [
            'page' => 'shop.html',
            'label' => [
                'name' => 'New',
                'color' => 'danger'
            ]
        ],
        'Blog' => [
            'page' => 'sale.html'
        ],
        'Gallery' => [
            'page' => route('product'),
            'label' => [
                'name' => 'Hot',
                'color' => 'success'
            ]
        ],
        'Contacts' => [
            'page' => route('contacts')
        ],
        'Purchase' => [
            'page' => route('catalog')
        ],
    ]
@endphp

<div class="menuModal" id="navigate">
    <ul class="menu menu_main">
        @foreach($menu as $key => $item)
            <li class="menu-item">
                @isset($item['label'])
                    @include('layouts.blocks.labels.label', ['label' => $item['label']])
                @endisset
                <a class="menu-link" href="{{ $item['page'] }}">{{ $key }}</a>
            </li>
        @endforeach
    </ul>
</div>
