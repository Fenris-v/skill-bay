@props(['discounts'])
<div class="wrap">
    <div class="Cards Cards_blog">
    @foreach($discounts as $discount)
        <x-discounts.discounts-item
            :discount="$discount"
            :dateFrom="$discount?->begin_at"
            :dateTo="$discount?->end_at"
        />
    @endforeach
    </div>
</div>