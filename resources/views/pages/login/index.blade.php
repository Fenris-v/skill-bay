{{--Основной шаблон страницы авторизации--}}
@extends('layouts.layout')

@section('title', 'Авторизация')

@section('meta_description', 'Описание страницы')

@section('content')
<div class="Middle Middle_top">
    <div class="Middle-top">
      <div class="wrap">
        <div class="Middle-header">
          <h1 class="Middle-title">Авторизация</h1>
          <ul class="breadcrumbs Middle-breadcrumbs">
            <li class="breadcrumbs-item"><a href="/">Главная</a></li>
            <li class="breadcrumbs-item breadcrumbs-item_current"><span>Авторизация</span></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="Section">
      <div class="wrap">
        <x-login-form/>
      </div>
    </div>
  </div>
@endsection
