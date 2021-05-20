@props(['discount'])
<div class="Card">
    <a class="Card-picture" href="#">
        <img
            src="{{ $discount->image->url() }}"
            alt="{{ $discount->image->alt }}"
        />
    </a>
    @if($beginAt)
        <div class="Card-date">
            <strong class="Card-date-number">
                {{ $beginAt['day'] }}
            </strong><span class="Card-date-month">
                {{ $beginAt['month'] }}
            </span>
        </div>
    @endif
    <div class="Card-pin">
    </div>
    <div class="Card-content">
        <strong class="Card-title">
            <a href="#">{{ $discount->title }}</a>
        </strong>
        <div class="Card-description">
            {{ $discount->description }}
        </div>
    </div>
</div>