{{-- Ячейка заголовка в таблице сравнения --}}

@props(['product'])

<div class="Compare-product">
    <div class="Compare-nameProduct Compare-nameProduct_main">{{ $product->title }}
    </div>
    <div class="Compare-feature"><img class="Compare-pict" src="{{ $product->image->url() }}" alt="card.jpg"/>
    </div>
</div>
