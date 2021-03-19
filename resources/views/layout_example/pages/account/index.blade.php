{{--Личный кабинет--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'Личный кабинет',
        ],
    ];
@endphp
@extends('layouts.layout')

@section('title', 'Account')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'Личный кабинет', 'breadcrumbs' => $breadcrumbs])

    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            @include('pages.account.blocks.aside_nav')

            <div class="Section-content">
                <div class="Account">
                    @include('pages.account.blocks.account_bio')

                    @include('pages.account.blocks.orders.order_last')

                    @include('pages.account.blocks.views_history')
                </div>
            </div>
        </div>
    </div>
@endsection
