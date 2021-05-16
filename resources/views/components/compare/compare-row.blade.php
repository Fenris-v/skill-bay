{{-- Строка в таблице сравнения --}}
<div class="Compare-row {{ $isSameSpecification ? 'Compare-row_hide' : '' }}">
    <div class="Compare-title">{{ $title }}
    </div>
    <div class="Compare-products">
        @foreach($products as $product)
            <x-compare.compare-specification-cell :title="$title" :product="$product"></x-compare.compare-specification-cell>
        @endforeach
    </div>
</div>
