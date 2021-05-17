{{--Шаблон продавца--}}
@extends('layouts.layout')

@section('title', 'Megano')

@section('meta_description', __('cartPage.metaDescription'))

@section('middle-header-h1', __('cartPage.title'))

@section('content')
    <div class="Section">
        <x-cart :products="$products"/>
    </div>
@endsection
