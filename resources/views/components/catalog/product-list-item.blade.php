<div class="Card">
    <a class="Card-picture" href="{{ route('products.show', $product) }}">
        <img src="{{ $product->image->url() }}" alt="card.jpg"/>
    </a>
    <div class="Card-content">
        <strong class="Card-title">
            <a href="{{ route('products.show', $product) }}">{{ $product->title }}</a>
        </strong>
        <div class="Card-description">
            <div class="Card-cost">
                <span class="Card-priceOld">
                    @price($product->average_price ?? 0)
                </span>
                <span class="Card-price">
                    @price($product->average_price ?? 0)
                </span>
            </div>
            <div class="Card-category">{{ $product->category->name }}</div>

            <x-catalog.product-control :product="$product"/>
        </div>
    </div>

    <x-labels.discount>60</x-labels.discount>
</div>
