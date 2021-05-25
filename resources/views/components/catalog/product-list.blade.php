<div class="Cards {{ $class }}">
    @forelse($products as $product)
        <x-catalog.product-list-item :product="$product" :discount-unit="$getDiscount($product)" />
    @empty
        <x-catalog.nothing/>
    @endforelse
</div>
