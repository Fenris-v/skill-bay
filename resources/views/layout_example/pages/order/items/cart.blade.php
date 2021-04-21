{{--Карточка товара в корзине--}}
<div class="Cart-product">
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_pict">
            <a class="Cart-pict" href="{{ $item['link'] }}">
                <img class="Cart-img" src="{{ $item['img'] ?? '' }}" alt="{{ $item['alt'] ?? '' }}"/>
            </a>
        </div>
        <div class="Cart-block Cart-block_info">
            <a class="Cart-title" href="{{ $item['link'] }}">{{ $item['name'] }}</a>
            <div class="Cart-desc">{{ $item['description'] }}</div>
        </div>
        <div class="Cart-block Cart-block_price">
            @isset($item['oldPrice'])
                <div class="Cart-price Cart-price_old">@price($item['oldPrice'])$</div>
            @endisset
            <div class="Cart-price">@price($item['price'])$</div>
        </div>
    </div>

    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_seller">
            <!-- - var options = setOptions(items, ['value', 'selected', 'disabled']);-->
            <select class="form-select">
                <option value="good" selected="selected">shop good</option>
                <option value="kke">shop kke</option>
                <option value="sssssl">market sssssl</option>
            </select>
        </div>
        <div class="Cart-block Cart-block_amount">
            <div class="Cart-amount">
                @include('layouts.blocks.amount')
            </div>
        </div>
        <div class="Cart-block Cart-block_delete">
            <a class="Cart-delete" href="#">
                <img src="/assets/img/icons/card/delete.svg" alt="delete.svg"/>
            </a>
        </div>
    </div>
</div>
