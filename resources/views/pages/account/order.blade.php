@extends('layouts.layout')

@section('title', 'История просмотра')

@section('meta_description', '')

@section('middle-header-h1', __('navigation.history'))

@section('content')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            @include('pages.account.aside')

            <div class="Section-content">
                <x-account.order :order="$order" />
            </div>
        </div>
    </div>
@endsection
