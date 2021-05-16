<x-product.product-handler>
    <x-slot name="productBlockSlot">
        <x-product.product-block
            :product="$product"
            :productLink="$productLink"
            :price="$price"
            :priceOld="$priceOld"
        />
    </x-slot>
    <x-slot name="sellerBlockSlot">
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
    </x-slot>
    <x-slot name="amountBlockSlot">
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
                    :submitOnClick="true"
                >
                </x-amount>
            </div>
        </x-wrappers.form>
    </x-slot>
    <x-slot name="deleteBlockSlot">
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
    </x-slot>
</x-product.product-handler>