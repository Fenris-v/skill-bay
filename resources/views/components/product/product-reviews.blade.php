@if($reviews->isNotEmpty())
    <div class="Comments">
        <div class="Comments-list" data-reviews-page="{{ $reviews->currentPage() }}" data-reviews-lastpage="{{ $reviews->lastPage() }}">
            <x-product.product-review-list :reviews="$reviews" />
        </div>

        @if ($reviews->hasMorePages())
            <div class="Comments-loadMore">
                <button class="btn btn_primary" type="button" id="reviewsLoadMore" data-load-url="{{ route('products.reviews', $product, false) }}">
                    @lang('navigation.load_more')
                </button>
            </div>
        @endif
    </div>
@endif

<header class="Section-header Section-header_product">
    <h3 class="Section-title">@lang('product.post_review')</h3>
</header>

<div class="Tabs-addComment">
    <x-product.product-review-form />
</div>
