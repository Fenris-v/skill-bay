{{--Основной шаблон страницы забыли пароль--}}
@extends('layouts.layout')

@section('title', __('login.forgot'))

@section('meta_description', __('login.desc'))

@section('middle-header-h1', __('login.forgot'))

@section('content')
    <div class="Section">
        <div class="wrap">
            <x-forgot-password-form/>
        </div>
    </div>
@endsection
