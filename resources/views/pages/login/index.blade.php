{{--Основной шаблон страницы авторизации--}}
@extends('layouts.layout')

@section('title', __('login.auth'))

@section('meta_description', __('login.desc'))

@section('middle-header-h1', __('login.auth'))

@section('content')
    <div class="Section">
        <div class="wrap">
            <x-login-form/>
        </div>
    </div>
@endsection
