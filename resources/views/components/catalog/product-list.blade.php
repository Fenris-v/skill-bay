<div class="Cards">
    @foreach($products as $product)
        <x-catalog.product-list-item :product="$product" />
    @endforeach
</div>
