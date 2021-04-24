<div class="Cart-product">
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_pict">
            <a class="Cart-pict" href="{{ $productLink }}">
                <img
                    class="Cart-img"
                    src="{{ $product->images->first()?->getUrl() }}"
                    alt="{{ $product->images?->first() }}"
                />
            </a>
        </div>
        <div class="Cart-block Cart-block_info">
            <a class="Cart-title" href="{{ $productLink }}">{{ $product->title }}</a>
            <div class="Cart-desc">
                {{ $product->description }}
            </div>
        </div>
        <div class="Cart-block Cart-block_price">
            @if($price < $priceOld)
                <div class="Cart-price Cart-price_old">
                    <nobr>@price($priceOld)</nobr>
                </div>
            @endif
            <div class="Cart-price">
                <nobr>@price($price)</nobr>
            </div>
        </div>
    </div>
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_seller">
            <x-wrappers.form-elements.select
                :name="'product_' . $product->id . '_seller'"
                :items="$sellers"
            />
        </div>
        <div class="Cart-block Cart-block_amount">
            <div class="Cart-amount">
                <x-amount
                    buttons-type="submit"
                    :value="$amount"
                    minus-button-click="alert(1)"
                    plus-button-click="alert(1)"
                >
                </x-amount>
            </div>
        </div>
        <div class="Cart-block Cart-block_delete">
            <x-wrappers.button
                class="Cart-delete"
                type="submit"
                icon="icons.card.delete"
            ></x-wrappers.button>
        </div>
    </div>
</div>