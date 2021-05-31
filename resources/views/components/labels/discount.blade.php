<div class="Card-sale">
    @if($discount->unit_type === Discount::UNIT_PERCENT)
        -{{ $discount->value }}%
    @else
        -@price($discount->value)
    @endif
</div>
