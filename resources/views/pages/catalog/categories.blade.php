@extends('layouts.layout')

@section('title', 'Каталог')

@section('meta_description', '')

@section('middle-header-h1', __('navigation.catalog'))

@section('content')
        <div class="Section Section_column Section_columnLeft">
            <div class="wrap">
                <x-catalog.filter.filter :sellers="$sellers" :specifications="$specifications"
                                         :specifications-values="$specificationsValues" :min-max-price="$minMaxPrice"/>

                <div class="Section-content">
                    <x-catalog.sort sort-props="popularity,price,reviews,newer"/>

                    <x-catalog.product-list :products="$products"/>

                    {{ $products->links() }}
                </div>
            </div>
        </div>
@endsection
