<div class="Card">
    <a class="Card-picture" href="{{ route('products.show', $product) }}">
        <img src="{{ $product->image->url() }}" alt="card.jpg"/>
    </a>

        <div class="Card-content">
            <strong class="Card-title">
                <a href="{{ route('products.show', $product) }}">{{ $product->title }}</a>
            </strong>

            @unless ($hideDetails)
                <div class="Card-description">
                    <div class="Card-cost">
                        @if($discount)
                            <span class="Card-priceOld">
                                @price($product->avg_price ?? 0)
                            </span>
                            <span class="Card-price">
                                @price($price)
                            </span>
                        @else
                            <span class="Card-price">
                                @price($product->avg_price ?? 0)
                            </span>
                        @endif
                    </div>
                    <div class="Card-category">{{ $product->category->name }}</div>

                    <x-catalog.product-control :product="$product"/>
                </div>
            @endunless
        </div>

    @if($discount)
        <x-labels.discount :discount="$discount"/>
    @endif
</div>
