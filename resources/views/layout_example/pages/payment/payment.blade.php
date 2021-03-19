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
            <form class="form Payment" action="#" method="post">
                <div class="Payment-card">
                    <div class="form-group">
                        <label class="form-label">Номер карты
                        </label>
                        <input class="form-input Payment-bill" id="numero1" name="numero1" type="text"
                               placeholder="9999 9999" data-mask="9999 9999" data-validate="require pay"/>
                    </div>
                </div>
                <div class="Payment-pay">
                    <a class="btn btn_primary" href="progressPayment.html">Оплатить</a>
                </div>
            </form>
        </div>
    </div>
@endsection
