@php
/** @var \Illuminate\Database\Eloquent\Collection $products */
@endphp

@unless($products->isEmpty())
    <div class="Section-content">
        <header class="Section-header">
            <h2 class="Section-title">@lang('catalog.catalog_top')</h2>
        </header>
        <div class="Cards">
            @foreach($products as $product)
                <x-catalog.product-list-item :product="$product" />
            @endforeach
        </div>
    </div>
@endunless
