{{-- Ячейка с кнопками в таблице сравнения --}}

@props(['product'])

<div class="Compare-product">
    <div class="Compare-nameProduct">{{ $product->title }}
    </div>
    <div class="Compare-feature">
        <x-wrappers.icon-form
            icon='icons.catalog.to-cart'
            method='post'
            route='products.addToCart'
            :product='$product'
            :formId='uniqid()'
        />
        <x-wrappers.icon-form
            icon='icons.catalog.delete'
            method='post'
            route='products.removeFromCompare'
            :product='$product'
            :formId='uniqid()'
        />
    </div>
</div>
