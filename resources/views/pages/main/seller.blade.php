{{--Шаблон продавца--}}
@extends('layouts.layout')

@section('title', 'Megano')

@section('meta_description', __('sellerPage.metaDescription'))

@section('middle-header-h1', __('sellerPage.title') . ' ' . $seller->title )

@section('content')
    <div class="Section Section_column Section_columnLeft Section_columnWide">
        <div class="wrap">
            <x-seller :seller="$seller">
                <header class="Section-header">
                    <h2 class="Section-title">{{ __('sellerPage.popularProducts') }}</h2>
                </header>
                <div class="Cards">
                    <x-catalog.product-list :products="$seller->topProducts" :hideDetails="true" />
                </div>
            </x-seller>
        </div>
    </div>
@endsection
