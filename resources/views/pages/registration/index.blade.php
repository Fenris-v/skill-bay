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
        <form class="form Authorization" action="#" method="post">
          <div class="row">
            <div class="row-block">
				<x-user-field type="password"/>
              <div class="form-group">
                <label class="form-label" for="phone">Телефон</label>
                <input class="form-input" id="phone" name="phone" type="text" placeholder="+70000000000" data-validate="require">
              </div>
              <div class="form-group">
                <label class="form-label" for="mail">E-mail</label>
                <input class="form-input" id="mail" name="mail" type="text" placeholder="send@test.test">
              </div>
              <div class="form-group">
                <label class="form-label" for="password">Пароль</label>
                <input class="form-input" id="password" name="password" type="password" placeholder="Выберите пароль">
              </div>
              <div class="form-group">
                <label class="form-label" for="passwordReply">Подтверждение пароля</label>
                <input class="form-input" id="passwordReply" name="passwordReply" type="password" placeholder="Введите пароль повторно">
              </div>
              <div class="form-group">
                  <button class="btn btn_primary" type="submit">Зарегистрироваться</button>
              </div>
              
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
