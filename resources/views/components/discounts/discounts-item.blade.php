@props(['discount', 'dateFrom' => null, 'dateTo' => null])
<div class="Card">
    <a class="Card-picture" href="#">
        <img
            src="{{ $discount->image->url() }}"
            alt="{{ $discount->image->alt }}"
        />
    </a>
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
    @if(false)
        <div class="Card-pin">
            <!--Для чего это?-->
        </div>
    @endif
    <div class="Card-content">
        <strong class="Card-title">
            <a href="#">{{ $discount->title }}</a>
        </strong>
        <div class="Card-description">
            {{ $discount->description }}
        </div>
    </div>
</div>