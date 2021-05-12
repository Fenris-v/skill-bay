{{--Таблица сравнения товаров--}}
@extends('layouts.layout')

@section('title', __('comparePage.title'))

@section('middle-header-h1', __('navigation.compare'))

@section('content')
    <div class="Section">
        <div class="wrap">
            <article class="Article">
                <p>{{ __('comparePage.description') }}</p>
            </article>
            @if ($products->count())
            <div class="Compare">
                <div class="Compare-header">
                    <label class="toggle Compare-checkDifferent">
                        <input type="checkbox" name="differentFeature" value="true" checked="checked"/><span class="toggle-box"></span><span class="toggle-text">{{ __('comparePage.onlyDiffSpecifications') }}</span>
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
                    <div class="Compare-title">{{ __('comparePage.price') }}
                    </div>
                    <div class="Compare-products">
                        @foreach($products as $product)
                            <x-compare.compare-price-cell :product="$product"/>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
                <h2>{{ __('comparePage.compareListIsEmpty') }}</h2>
            @endif
        </div>
    </div>
@endsection
