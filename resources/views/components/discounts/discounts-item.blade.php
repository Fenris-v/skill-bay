@props(['discount', 'dateFrom' => null, 'dateTo' => null])
<div class="Card">
    <div class="Card-picture">
        <img
            src="{{ $discount->image->url() }}"
            alt="{{ $discount->image->alt }}"
        />
    </div>
    @if($dateFrom)
        <x-discounts.discounts-date
            :date="$dateFrom"
        />
    @endif
    @if($dateTo)
        <x-discounts.discounts-date
            class="Card-date_to"
            :date="$dateTo"
        />
    @endif
    <div class="Card-content">
        <strong class="Card-title">
            {{ $discount->title }}
        </strong>
        <div class="Card-description">
            {{ $discount->description }}
        </div>
    </div>
</div>