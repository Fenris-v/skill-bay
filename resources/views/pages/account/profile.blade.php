@extends('layouts.layout')

@section('title', __('navigation.profile'))

@section('meta_description', '')

@section('middle-header-h1', __('navigation.profile'))

@section('content')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            @include('pages.account.aside')

            <div class="Section-content">
                <div class="Profile">
                    <x-profile-form :user="$user"/>
                </div>
            </div>
        </div>
    </div>
@endsection
