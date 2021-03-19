{{--Карточка товара--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'Product',
        ],
    ];

    $images = [
        [
            'src' => '/assets/img/content/home/bigGoods.png',
            'alt' => 'bigGoods.png',
        ],
        [
            'src' => '/assets/img/content/home/slider.png',
            'alt' => 'slider.png',
        ],
        [
            'src' => '/assets/img/content/home/videoca.png',
            'alt' => 'videoca.png',
        ],
    ];
@endphp

@extends('layouts.layout')

@section('title', 'Product')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'Catalog', 'breadcrumbs' => $breadcrumbs])

    <div class="Section">
        <div class="wrap">
            <div class="Product">
                <div class="ProductCard">
                    <div class="ProductCard-look">
                        <div class="ProductCard-photo">
                            @include('layouts.blocks.labels.label_discount', ['discount' => '-15%'])
                            <img src="/assets/img/content/home/bigGoods.png" alt="bigGoods.png"/>
                        </div>
                        <div class="ProductCard-picts">
                            @each('pages.product.images', $images, 'img')
                        </div>
                    </div>

                    @include('pages.product.desc')
                </div>

                @include('pages.product.tabs.tabs')
            </div>
        </div>
    </div>
@endsection
