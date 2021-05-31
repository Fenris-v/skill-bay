<div class="Cart-product">
    {{ $productBlockSlot }}
    <div class="Cart-block Cart-block_row">
        <div class="Cart-block Cart-block_seller">
            {{ $sellerBlockSlot }}
        </div>
        <div class="Cart-block Cart-block_amount">
            {{ $amountBlockSlot }}
        </div>
        @if($deleteBlockSlot)
            <div class="Cart-block Cart-block_delete">
                {{ $deleteBlockSlot }}
            </div>
        @endif
    </div>
</div>