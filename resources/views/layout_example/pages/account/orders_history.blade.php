{{--Личный кабинет - история заказов--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'История заказов',
        ],
    ];
@endphp

@extends('layouts.layout')

@section('title', 'Orders history')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'История заказов', 'breadcrumbs' => $breadcrumbs])

    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            @include('pages.account.blocks.aside_nav')

            <div class="Section-content">
                @include('pages.account.blocks.orders.orders_list')
            </div>
        </div>
    </div>
@endsection
