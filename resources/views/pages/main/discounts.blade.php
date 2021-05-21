{{--Шаблон списка скидок--}}
@extends('layouts.layout')

@section('title', 'Megano')

@section('meta_description', __('discountsPage.metaDescription'))

@section('middle-header-h1', __('discountsPage.title'))

@section('content')
    <div class="Section">
        <x-discounts.discounts-list
            :discounts="$discounts"
        />
    </div>
    <div class="Pagination">
        {{ $discounts->links() }}
    </div>
@endsection