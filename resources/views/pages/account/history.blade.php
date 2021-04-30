@extends('layouts.layout')

@section('title', 'История просмотра')

@section('meta_description', '')

@section('middle-header-h1', __('navigation.history'))

@section('content')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            <div class="Section-column">
                <div class="Section-columnSection">
                    <header class="Section-header">
                        <strong class="Section-title">Навигация</strong>
                    </header>
                    <div class="Section-columnContent">
                        <div class="NavigateProfile">
                            <ul class="menu menu_vt">
                                <li class="menu-item"><a class="menu-link" href="account.html">Личный кабинет</a></li>
                                <li class="menu-item"><a class="menu-link" href="profile.html">Профиль</a></li>
                                <li class="menu-item"><a class="menu-link" href="historyorder.html">История заказов</a></li>
                                <li class="menu-item_ACTIVE menu-item">
                                    <a class="menu-link" href="{{ route('viewed_history') }}">История просмотра</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="Section-content">
                <x-catalog.product-list :products="$products" />
            </div>
        </div>
    </div>
@endsection
