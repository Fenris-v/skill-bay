{{--Шаблон продавца--}}
@extends('layouts.layout')

@section('title', 'Megano')

@section('middle-header-h1', __('productPage.title'))

@section('content')
    <div class="Section">
        <div class="wrap">
            <x-product :product="$product"/>
        </div>
    </div>
@endsection
