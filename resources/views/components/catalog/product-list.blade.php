<div class="Cards">
    @forelse($products as $product)
        <x-catalog.product-list-item :product="$product"/>
    @empty
        <x-catalog.nothing/>
    @endforelse
</div>
