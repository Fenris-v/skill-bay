@foreach($reviews as $review)
    <x-product.product-review-comment :review="$review" />
@endforeach
