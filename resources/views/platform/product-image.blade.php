@if($product->image)
    <img src="{{ $product->image->url }}" class="mw-100 d-block img-fluid" alt="">
@endif
<span class="small text-muted mt-1 mb-0">#{{ $product->id }}</span>
