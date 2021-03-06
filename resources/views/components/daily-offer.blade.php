{{-- Блок предложение дня --}}
@if ($product)
<div class="Section-column">
    <div class="Section-columnSection Section-columnSection_mark">
        <header class="Section-columnHeader">
            <strong class="Section-columnTitle">{{ __('dailyOffer.title') }}</strong>
        </header>
        <div class="Card">
            <a class="Card-picture" href="{{ route('products.show', [$product]) }}"><img src="{{ $product->image->url() }}" alt="{{ $product->title }}"/></a>
            <div class="Card-content">
                <strong class="Card-title"><a href="{{ route('products.show', [$product]) }}">{{ $product->title }}</a></strong>
                <div class="Card-description">
                    <div class="Card-cost">
                        @if($product->priceOld > $product->price)
                            <span class="Card-priceOld">@price($product->priceOld)</span>
                        @endif
                        <span class="Card-price">@price($product->price)</span>
                    </div>
                    <div class="Card-category">{{ $product->category->name }}</div>
                </div>
                <div class="CountDown" data-date="{{ $time->format('d.m.Y H:i') }}">
                    <div class="CountDown-block">
                        <div class="CountDown-wrap">
                            <div class="CountDown-days"></div><span class="CountDown-label">{{ __('dailyOffer.timer.days') }}</span>
                        </div>
                    </div>
                    <div class="CountDown-block">
                        <div class="CountDown-wrap">
                            <div class="CountDown-hours"></div><span class="CountDown-label">{{ __('dailyOffer.timer.hours') }}</span>
                        </div>
                    </div>
                    <div class="CountDown-block">
                        <div class="CountDown-wrap">
                            <div class="CountDown-minutes"></div><span class="CountDown-label">{{ __('dailyOffer.timer.minutes') }}</span>
                        </div>
                    </div>
                    <div class="CountDown-block">
                        <div class="CountDown-wrap">
                            <div class="CountDown-secs"></div><span class="CountDown-label">{{ __('dailyOffer.timer.seconds') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
