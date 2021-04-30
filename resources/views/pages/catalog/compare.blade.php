{{--Таблица сравнения товаров--}}
@extends('layouts.layout')

@section('title', 'Сравнение товаров')

@section('middle-header-h1', __('navigation.compare'))

@section('content')
    <div class="Section">
        <div class="wrap">
            <article class="Article">
                <p>Разнообразный и богатый опыт постоянный количественный рост и сфера нашей активности обеспечивает широкому кругу (специалистов) участие в формировании системы обучения кадров, соответствует насущным потребностям. Идейные соображения высшего порядка, а также консультация с широким активом требуют определения и уточнения соответствующий условий активизации.
                </p>
            </article>
            @if ($products->count())
            <div class="Compare">
                <div class="Compare-header">
                    <label class="toggle Compare-checkDifferent">
                        <input type="checkbox" name="differentFeature" value="true" checked="checked"/><span class="toggle-box"></span><span class="toggle-text">Только различающиеся характеристики</span>
                    </label>
                </div>
                {{-- Заголовки --}}
                <div class="Compare-row">
                    <div class="Compare-title Compare-title_blank">
                    </div>
                    <div class="Compare-products">
                        @foreach($products as $product)
                            <x-compare.compare-head-cell :product="$product"/>
                        @endforeach
                    </div>
                </div>
                {{-- Кнопки --}}
                <div class="Compare-row">
                    <div class="Compare-title Compare-title_blank">
                    </div>
                    <div class="Compare-products">
                        @foreach($products as $product)
                            <x-compare.compare-buttons-cell :product="$product"/>
                        @endforeach
                    </div>
                </div>
                {{-- Характеристики товаров --}}
                @foreach($allCommonSpecifications as $specifications)
                    <x-compare.compare-row :specifications="$specifications" :products="$products"></x-compare.compare-row>
                @endforeach
                {{-- Цены товаров --}}
                <div class="Compare-row">
                    <div class="Compare-title">Цена
                    </div>
                    <div class="Compare-products">
                        @foreach($products as $product)
                            <x-compare.compare-price-cell :product="$product"/>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
                <h2>В списке сравнения товаров пока пусто</h2>
            @endif
        </div>
    </div>
@endsection
