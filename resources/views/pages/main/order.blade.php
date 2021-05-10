{{--Оформление заказа--}}
@extends('layouts.layout')

@section('title', __('orderPagePage.title'))

@section('meta_description', __('orderPagePage.metaDescription'))

@section('middle-header-h1', __('orderPage.title'))

@section('content')
    <div class="Section Section_column Section_columnRight Section_columnWide Order">
        <div class="wrap">
            <div class="Section-column">
                <x-order.progress :completed-steps="$completedSteps"/>
            </div>
            <div class="Section-content">
                <form class="form" action="{{ url()->current() }}" method="post">
                    @csrf
                    <x-dynamic-component
                        :component="$component"
                        :user="auth()->user()"
                    />
                </form>
            </div>
        </div>
    </div>
@endsection
