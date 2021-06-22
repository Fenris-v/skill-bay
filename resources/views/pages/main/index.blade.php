{{--Основной шаблон главной страницы--}}
@extends('layouts.layout')

@section('title', 'Megano')

@section('meta_description', 'Описание страницы')

@section('content')
    <x-banners.banners />

    <div class="Middle">
        <x-categories.hot-list />

        <div class="Section Section_column Section_columnLeft Section_columnDesktop">
            <div class="wrap">
                <x-daily-offer />
                <x-catalog.product-top />
            </div>
        </div>

        <div class="Section Section_column Section_columnRight">
            <div class="wrap">
                <x-aside.advantages />
                <div class="Section-content">
                    <x-limited-edition />
                </div>
            </div>
        </div>
    </div>
@endsection
