{{-- Блок предложение дня --}}
<div class="Section-column">
    <div class="Section-columnSection Section-columnSection_mark">
        <header class="Section-columnHeader">
            <strong class="Section-columnTitle">Предложение дня</strong>
        </header>
        <div class="Card">
            <a class="Card-picture" href="{{ route('products.show', [$product]) }}"><img src="{{ $product->image->url() }}" alt="card.jpg"/></a>
            <div class="Card-content">
                <strong class="Card-title"><a href="{{ route('products.show', [$product]) }}">{{ $product->title }}</a></strong>
                <div class="Card-description">
                    <div class="Card-cost">
                        <span class="Card-priceOld">@price($product->averagePrice)</span>
                        <span class="Card-price">@price($product->averagePrice)</span>
                    </div>
                    <div class="Card-category">{{ $product->category->name }}</div>
                </div>
                <div class="CountDown" data-date="{{ $time->format('d.m.Y H:i') }}">
                    <div class="CountDown-block">
                        <div class="CountDown-wrap">
                            <div class="CountDown-days"></div><span class="CountDown-label">дней</span>
                        </div>
                    </div>
                    <div class="CountDown-block">
                        <div class="CountDown-wrap">
                            <div class="CountDown-hours"></div><span class="CountDown-label">часов</span>
                        </div>
                    </div>
                    <div class="CountDown-block">
                        <div class="CountDown-wrap">
                            <div class="CountDown-minutes"></div><span class="CountDown-label">минут</span>
                        </div>
                    </div>
                    <div class="CountDown-block">
                        <div class="CountDown-wrap">
                            <div class="CountDown-secs"></div><span class="CountDown-label">секунд</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
