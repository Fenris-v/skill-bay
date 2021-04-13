{{--Шаблон продавца--}}
@extends('layouts.layout')

@section('title', 'Megano')

@section('meta_description', 'Товар')

@section('content')
    <div class="Middle Middle_top">
        <div class="Middle-top">
            <div class="wrap">
                <div class="Middle-header">
                    <h1 class="Middle-title">Товар</h1>
                    <x-wrappers.breadcrumbs
                        :items="$breadcrumbs"
                    />
                </div>
            </div>
        </div>
        <div class="Section">
            <div class="wrap">
                <x-product :product="$product"/>
            </div>
        </div>
    </div>
@endsection