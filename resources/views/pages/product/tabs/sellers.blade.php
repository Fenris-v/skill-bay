{{--Продавцы--}}
@php
    $sellers = [
        'Очень дешево',
        'pleer.ru',
        'citilink.ru',
        'М.Видео',
    ];
@endphp
<div class="Tabs-block" id="sellers">
    <div class="Categories Categories_product">
        @each('pages.product.tabs.seller', $sellers, 'seller')
    </div>
</div>
