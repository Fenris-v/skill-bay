{{--Страница "о нас"--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'about'
        ],
    ];

    $follows = [
        [
            'img' => '/assets/img/icons/socialContent/fb.png',
            'alt' => 'fb.png',
        ],
        [
            'img' => '/assets/img/icons/socialContent/tw.png',
            'alt' => 'tw.png',
        ],
        [
            'img' => '/assets/img/icons/socialContent/gg.png',
            'alt' => 'gg.png',
        ],
        [
            'img' => '/assets/img/icons/socialContent/in.png',
            'alt' => 'in.png',
        ],
        [
            'img' => '/assets/img/icons/socialContent/pt.png',
            'alt' => 'pt.png',
        ],
        [
            'img' => '/assets/img/icons/socialContent/ml.png',
            'alt' => 'ml.png',
        ],
    ];
@endphp

@extends('layouts.layout')

@section('title', 'About')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'About Megano', 'breadcrumbs' => $breadcrumbs])

    <div class="Section Section_column Section_columnLeft Section_columnWide">
        <div class="wrap">
            @include('layouts.blocks.advantages', ['follows' => $follows])

            <div class="Section-content">
                @include('layouts.blocks.articles.article')
            </div>
        </div>
    </div>
@endsection
