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
            <x-wrappers.form
                class="form Cart"
                action="{{ $changeProductSellerUrl }}"
                method="patch"
                class="form Cart"
            >
                <x-wrappers.form-elements.select
                    name="seller"
                    :items="$sellers"
                    onchange="submit()"
                />
            </x-wrappers.form>
        </div>
        <div class="Cart-block Cart-block_amount">
            <x-wrappers.form
                    class="form Cart"
                    action="{{ $changeProductAmountUrl }}"
                    method="patch"
                    class="form Cart"
            >
                <div class="Cart-amount">
                    <x-amount
                        buttons-type="submit"
                        :value="$amount"
                        changeAmount="submit()"
                    >
                    </x-amount>
                </div>
            </x-wrappers.form>
        </div>

        <div class="Cart-block Cart-block_delete">
            <x-wrappers.form
                method="post"
                action="{{ $removeProductFromCartUrl }}"
                class="form Cart"
                method="patch"
            >
                <x-wrappers.button
                    class="Cart-delete"
                    type="submit"
                    icon="icons.card.delete"
                ></x-wrappers.button>
            </x-wrappers.form>
        </div>
    </div>
</div>