{{--Элемент слайдера с 2мя слайдами--}}
<div class="Slider-item">
    <div class="Slider-content">
        <div class="Card">
            <a class="Card-picture" href="{{ $item['link'] }}">
                <img src="{{ $item['image'] ?? '' }}" alt="{{ $item['alt'] }}"/>
            </a>
            <div class="Card-content">
                <strong class="Card-title">
                    <a href="{{ $item['link'] }}">{{ $item['name'] }}</a>
                </strong>
                <div class="Card-description">
                    <div class="Card-cost">
                        <span class="Card-priceOld">$@price($item['oldPrice'])</span>
                        <span class="Card-price">$@price($item['price'])</span>
                    </div>

                    <div class="Card-category">{{ $item['category'] }}</div>

                    @include('layouts.blocks.cards.card_hover_btns')
                </div>
            </div>

            @if($item['discount'])
                @include('layouts.blocks.labels.label_discount', ['discount' => $item['discount']])
            @endif
        </div>
    </div>
</div>
