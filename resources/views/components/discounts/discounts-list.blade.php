@props(['discounts'])
<div class="wrap">
    <div class="Cards Cards_blog">
    @foreach($discounts as $discount)
        <x-discounts.discounts-item
            :discount="$discount"
        />
    @endforeach
    </div>
</div>
@dump($discounts)