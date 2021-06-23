{{-- Ячейка спецификаций в таблице сравнения --}}
<div class="Compare-product">
    <div class="Compare-nameProduct">{{ $product->title }}
    </div>
    <div class="Compare-feature">
        @if($isCheckbox)
            {{ (bool)$specificationValue === true ? __('general.yes') : __('general.no') }}
        @else
            {{ $specificationValue }}
        @endif
    </div>
</div>
