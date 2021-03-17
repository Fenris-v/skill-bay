{{--Наименование в заказе--}}
<div class="Cart-product">
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_pict">
            <a class="Cart-pict" href="{{ $item['link'] }}">
                <img class="Cart-img" src="{{ $item['img'] ?? '' }}" alt="{{ $item['alt'] ?? '' }}"/>
            </a>
        </div>

        <div class="Cart-block Cart-block_info">
            <a class="Cart-title" href="{{ $item['link'] }}">{{ $item['name'] }}</a>
            <div class="Cart-desc">{{ $item['description'] ?? '' }}</div>
        </div>
        <div class="Cart-block Cart-block_price">
            @isset($item['oldPrice'])
                <div class="Cart-price_old">@price($item['oldPrice'])$</div>
            @endisset

            <div class="Cart-price">@price($item['price'])$</div>
        </div>
    </div>
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_seller">
            <div>Продавец:</div>
            <div>{{ $item['seller'] }}</div>
        </div>
        <div class="Cart-block Cart-block_amount">{{ $item['amount'] }} шт.</div>
    </div>
</div>
