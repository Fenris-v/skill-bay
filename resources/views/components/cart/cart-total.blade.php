<div class="Cart-total">
    <div class="Cart-block Cart-block_total">
        <strong class="Cart-title">
            {{ __('cartPage.total') }}:
        </strong>
        <span class="Cart-price">
            @price($currentTotal)
        </span>
        @if($currentTotal < $oldTotal)
            <span class="Cart-price_old">
                @price($oldTotal)
            </span>
        @endif
    </div>
    <div class="Cart-block">
        <x-wrappers.button
            class="btn btn_success btn_lg"
            type="submit"
            title="{{ __('cartPage.toOrder') }}"
        ></x-wrappers.button>
    </div>
</div>