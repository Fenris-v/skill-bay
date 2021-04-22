<div class="Comments">
    @foreach($reviews as $review)
        <x-product.product-review-comment :review="$review" />
    @endforeach
</div>

<header class="Section-header Section-header_product">
    <h3 class="Section-title">Оставить отзыв</h3>
</header>

<div class="Tabs-addComment">
    <x-product.product-review-form />
</div>
