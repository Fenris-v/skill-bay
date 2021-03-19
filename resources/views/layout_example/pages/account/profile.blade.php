{{--Личный кабинет - профиль--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'Профиль',
        ],
    ];
@endphp

@extends('layouts.layout')

@section('title', 'Profile')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'Профиль', 'breadcrumbs' => $breadcrumbs])

    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            @include('pages.account.blocks.aside_nav')

            <div class="Section-content">
                <div class="Profile">
                    <form class="form Profile-form" action="#" method="post">
                        <div class="row">
                            <div class="row-block">
                                <div class="form-group">
                                    <label class="form-label" for="avatar">Аватар</label>
                                    <div class="Profile-avatar Profile-avatar_noimg">
                                        <div class="Profile-img">
                                            <img src="/assets/img/#.png" alt="#.png"/>
                                        </div>

                                        <label class="Profile-fileLabel" for="avatar">Выберите аватар</label>
                                        <input class="Profile-file form-input"
                                               id="avatar"
                                               name="avatar"
                                               type="file"
                                               data-validate="onlyImgAvatar"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="name">ФИО</label>
                                    <input class="form-input" id="name" name="name" type="text" value="" data-validate="require"/>
                                </div>
                            </div>
                            <div class="row-block">
                                <div class="form-group">
                                    <label class="form-label" for="phone">Телефон</label>
                                    <input class="form-input" id="phone" name="phone" type="text" value="+70000000000"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="mail">E-mail</label>
                                    <input class="form-input" id="mail" name="mail" type="text" value="send@test.test" data-validate="require"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="password">Пароль</label>
                                    <input class="form-input" id="password" name="password" type="password" placeholder="Тут можно изменить пароль"/>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="passwordReply">Подтверждение пароля</label>
                                    <input class="form-input" id="passwordReply" name="passwordReply" type="password" placeholder="Введите пароль повторно"/>
                                </div>
                                <div class="form-group">
                                    <div class="Profile-btn">
                                        <button class="btn btn_success" type="submit">Сохранить</button>
                                    </div>
                                    <div class="Profile-success">Профиль успешно сохранен</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
