{{-- Ячейка с ценой товара --}}

<div class="Compare-product">
    <div class="Compare-nameProduct">{{ $product->title }}
    </div>
    <div class="Compare-feature">
        <strong class="Compare-priceOld">@price($price)
        </strong>
        <strong class="Compare-price">@price($discountPrice)
        </strong>
    </div>
</div>