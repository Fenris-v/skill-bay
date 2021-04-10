{{--Основной шаблон страницы регистрации--}}
@extends('layouts.layout')

@section('title', 'Регистрация')

@section('meta_description', 'Описание страницы')

@section('content')
<div class="Middle Middle_top">
    <div class="Middle-top">
      <div class="wrap">
        <div class="Middle-header">
          <h1 class="Middle-title">Регистрация</h1>
          <ul class="breadcrumbs Middle-breadcrumbs">
            <li class="breadcrumbs-item"><a href="index.html">Главная</a></li>
            <li class="breadcrumbs-item breadcrumbs-item_current"><span>Регистрация</span></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="Section">
      <div class="wrap">
		  <x-registration-form/>
      </div>
    </div>
  </div>
@endsection
