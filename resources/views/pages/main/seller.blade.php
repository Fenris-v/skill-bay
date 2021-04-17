{{--Шаблон продавца--}}
@extends('layouts.layout')

@section('title', 'Megano')

@section('meta_description', 'Сведения о продавце')

@section('content')
    <div class="Middle Middle_top">
        <div class="Middle-top">
            <div class="wrap">
                <div class="Middle-header">
                    <h1 class="Middle-title">Продавец {{ $seller->title }}</h1>
                    <x-wrappers.breadcrumbs />
                </div>
            </div>
        </div>
        <div class="Section Section_column Section_columnLeft Section_columnWide">
            <div class="wrap">
                <x-seller :seller="$seller">
                    <header class="Section-header">
                        <h2 class="Section-title">Популярные товары продавца</h2>
                    </header>
                    <div class="Cards">
                        {{--Для дальнейшего редактирования--}}
                    </div>
                </x-seller>
            </div>
        </div>
    </div>
@endsection
