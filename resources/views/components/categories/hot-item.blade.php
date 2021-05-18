@php /** @var \App\Models\Category $category */@endphp
<a class="BannersHomeBlock" href="{{ route('products.index', $category->slug) }}">
    <div class="BannersHomeBlock-row">
        <div class="BannersHomeBlock-block">
            <strong class="BannersHomeBlock-title">{{ $category->name }}</strong>
            @if($category->product_sellers_min_price)
                <div class="BannersHomeBlock-content">
                    @lang('category.price_from')
                    <span class="BannersHomeBlock-price">
                        {{ floor($category->product_sellers_min_price) }}&#8381;
                    </span>
                </div>
            @endif
        </div>
        @if($category->image)
            <div class="BannersHomeBlock-block">
                <div class="BannersHomeBlock-img">
                    <img src="{{ $category->image->url() }}" />
                </div>
            </div>
        @endif
    </div>
</a>
