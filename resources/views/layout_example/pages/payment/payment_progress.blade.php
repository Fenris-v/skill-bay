{{--Оплата--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'Оплата',
        ],
    ];
@endphp

@extends('layouts.layout')

@section('title', 'Оформление заказа')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'Оплата', 'breadcrumbs' => $breadcrumbs])

    <div class="Section">
        <div class="wrap">
            <div class="ProgressPayment">
                <div class="ProgressPayment-title">Ждем подтверждения оплаты платежной системой
                </div>
                <div class="ProgressPayment-icon">
                    <div class="cssload-thecube">
                        <div class="cssload-cube cssload-c1"></div>
                        <div class="cssload-cube cssload-c2"></div>
                        <div class="cssload-cube cssload-c4"></div>
                        <div class="cssload-cube cssload-c3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
