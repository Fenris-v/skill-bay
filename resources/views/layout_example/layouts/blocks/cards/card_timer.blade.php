{{--Карточка ограниченного предложения--}}
<div class="Card">
    <a class="Card-picture" href="{{ $item['link'] }}">
        <img src="{{ $item['image'] ?? '' }}" alt="{{ $item['alt'] ?? '' }}"/>
    </a>
    <div class="Card-content">
        <strong class="Card-title">
            <a href="{{ $item['link'] }}">{{ $item['name'] }}</a>
        </strong>
        <div class="Card-description">
            <div class="Card-cost">
                @isset($item['oldPrice'])
                    <span class="Card-priceOld">$@price($item['oldPrice'])</span>
                @endisset
                <span class="Card-price">$@price($item['price'])</span>
            </div>
            <div class="Card-category">{{ $item['category'] }}</div>
        </div>
        <div class="CountDown" data-date="{{ $item['limitedEnd'] }}">
            <div class="CountDown-block">
                <div class="CountDown-wrap">
                    <div class="CountDown-days">
                    </div>
                    <span class="CountDown-label">days</span>
                </div>
            </div>
            <div class="CountDown-block">
                <div class="CountDown-wrap">
                    <div class="CountDown-hours">
                    </div>
                    <span class="CountDown-label">hours</span>
                </div>
            </div>
            <div class="CountDown-block">
                <div class="CountDown-wrap">
                    <div class="CountDown-minutes">
                    </div>
                    <span class="CountDown-label">mins</span>
                </div>
            </div>
            <div class="CountDown-block">
                <div class="CountDown-wrap">
                    <div class="CountDown-secs">
                    </div>
                    <span class="CountDown-label">secs</span>
                </div>
            </div>
        </div>
    </div>
</div>
