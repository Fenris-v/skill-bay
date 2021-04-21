{{--Скидки--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'Скидки',
        ],
    ];

    $discounts = [
        [
            'img' => '/assets/img/content/sale/product.png',
            'alt' => 'product.png',
            'date_at' => '24',
            'date_to' => '28',
        ],
        [
            'img' => '/assets/img/content/sale/product.png',
            'alt' => 'product.png',
            'date_to' => '24',
        ],
        [
            'img' => '/assets/img/content/sale/product.png',
            'alt' => 'product.png',
        ],
        [
            'img' => '/assets/img/content/sale/product.png',
            'alt' => 'product.png',
            'date_at' => '24',
            'date_to' => '28',
        ],
        [
            'img' => '/assets/img/content/sale/product.png',
            'alt' => 'product.png',
            'date_at' => '24',
            'date_to' => '28',
        ],
        [
            'img' => '/assets/img/content/sale/product.png',
            'alt' => 'product.png',
            'date_at' => '24',
            'date_to' => '28',
        ],
        [
            'img' => '/assets/img/content/sale/product.png',
            'alt' => 'product.png',
            'date_at' => '24',
            'date_to' => '28',
        ],
        [
            'img' => '/assets/img/content/sale/product.png',
            'alt' => 'product.png',
            'date_at' => '24',
            'date_to' => '28',
        ],
        [
            'img' => '/assets/img/content/sale/product.png',
            'alt' => 'product.png',
            'date_at' => '24',
            'date_to' => '28',
        ],
        [
            'img' => '/assets/img/content/sale/product.png',
            'alt' => 'product.png',
            'date_at' => '24',
            'date_to' => '28',
        ],
        [
            'img' => '/assets/img/content/sale/product.png',
            'alt' => 'product.png',
            'date_at' => '24',
            'date_to' => '28',
        ],
        [
            'img' => '/assets/img/content/sale/product.png',
            'alt' => 'product.png',
            'date_at' => '24',
            'date_to' => '28',
        ],
    ];
@endphp

@extends('layouts.layout')

@section('title', 'Скидки')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'Скидки', 'breadcrumbs' => $breadcrumbs])

    <div class="Section">
        <div class="wrap">
            <div class="Cards Cards_blog">
                @each('layouts.blocks.cards.blog', $discounts, 'item')
            </div>
        </div>
    </div>
@endsection
