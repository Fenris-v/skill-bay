{{--Основной шаблон страницы регистрации--}}
@extends('layouts.layout')

@section('title', __('login.reg'))

@section('meta_description', __('login.desc'))

@section('middle-header-h1', __('login.reg'))

@section('content')
    <div class="Section">
        <div class="wrap">
            <x-registration-form/>
        </div>
    </div>
@endsection
