@php /** @var \App\Models\Category $category */@endphp
<a class="BannersHomeBlock" href="{{ route('products.index', $category->slug) }}">
    <div class="BannersHomeBlock-row">
        <div class="BannersHomeBlock-block">
            <strong class="BannersHomeBlock-title">{{ $category->name }}</strong>
            <div class="BannersHomeBlock-content">от&#32;<span class="BannersHomeBlock-price">$210.00</span>
            </div>
        </div>
        <div class="BannersHomeBlock-block">
            <div class="BannersHomeBlock-img"><img src="assets/img/content/home/videoca.png" alt="videoca.png"/></div>
        </div>
    </div>
</a>
