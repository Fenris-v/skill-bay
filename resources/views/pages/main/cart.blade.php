{{--Шаблон продавца--}}
@extends('layouts.layout')

@section('title', 'Megano')

@section('meta_description', __('cartPage.metaDescription'))

@section('middle-header-h1', __('cartPage.title'))

@section('content')
    <div class="Section">
        <div class="wrap">
            <x-wrappers.form
                class="form Cart"
                action="/cart"
                method="post"
            >
                @foreach($products as $product)
                    <x-cart.cart-product
                        :product="$product"
                    />
                @endforeach
                <x-cart.cart-total />
            </x-wrappers.form>
        </div>
    </div>
@endsection
