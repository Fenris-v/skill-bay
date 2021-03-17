<div class="{{ $class ?? 'Card' }}">
    <a class="Card-picture" href="{{ route('product') }}">
        <img src="{{ $item['image'] ?? '' }}" alt="{{ $item['alt'] ?? '' }}"/>
    </a>

    <div class="Card-content">
        <strong class="Card-title">
            <a href="{{ route('product') }}">{{ $item['name'] }}</a>
        </strong>

        <div class="Card-description">
            <div class="Card-cost">
                @isset($item['oldPrice'])
                    <span class="Card-priceOld">$@price($item['oldPrice'])</span>
                @endisset

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
