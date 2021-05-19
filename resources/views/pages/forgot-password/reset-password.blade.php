{{--Основной шаблон страницы сбросить пароль--}}
@extends('layouts.layout')

@section('title', 'Сбросить пароль')

@section('meta_description', 'Описание страницы')

@section('content')
<div class="Middle Middle_top">
    <div class="Middle-top">
      <div class="wrap">
        <div class="Middle-header">
          <h1 class="Middle-title">Сбросить пароль</h1>
          <ul class="breadcrumbs Middle-breadcrumbs">
            <li class="breadcrumbs-item"><a href="index.html">Главная</a></li>
            <li class="breadcrumbs-item breadcrumbs-item_current"><span>Сбросить пароль</span></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="Section">
      <div class="wrap">
		    <x-reset-password-form :token="$token"/>
      </div>
    </div>
  </div>
@endsection
