@props(['productLink', 'product', 'price', 'priceOld'])
<div class="Cart-block Cart-block_row">
    <div class="Cart-block Cart-block_pict">
        <a class="Cart-pict" href="{{ $productLink }}">
            <img
                class="Cart-img"
                src="{{ $product->image->url }}"
                alt="{{ $product->image->url }}"
            />
        </a>
    </div>
    <div class="Cart-block Cart-block_info">
        <a class="Cart-title" href="{{ $productLink }}">{{ $product->title }}</a>
        <div class="Cart-desc">
            {{ $product->description }}
        </div>
    </div>
    <div class="Cart-block Cart-block_price">
        @if($price < $priceOld)
            <div class="Cart-price Cart-price_old">
                <nobr>@price($priceOld)</nobr>
            </div>
        @endif
        <div class="Cart-price">
            <nobr>@price($price)</nobr>
        </div>
    </div>
</div>