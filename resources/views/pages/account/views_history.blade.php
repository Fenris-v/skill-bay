{{--Личный кабинет - история просмотров--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'История просмотра',
        ],
    ];
@endphp

@extends('layouts.layout')

@section('title', 'Views history')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'История просмотра', 'breadcrumbs' => $breadcrumbs])

    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            @include('pages.account.blocks.aside_nav')

            <div class="Section-content">
                @include('layouts.blocks.cards.goods_list')
            </div>
        </div>
    </div>
@endsection
