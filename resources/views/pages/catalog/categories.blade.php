@extends('layouts.layout')

@section('title', 'Каталог')

@section('meta_description', '')

@section('content')
    <div class="Middle Middle_top">
        <div class="Middle-top">
            <div class="wrap">
                <div class="Middle-header">
                    <h1 class="Middle-title">{{ __('navigation.catalog') }}</h1>
                    <x-wrappers.breadcrumbs />
                </div>
            </div>
        </div>
        <div class="Section Section_column Section_columnLeft">
            <div class="wrap">
                <div class="Section-column">
                    <div class="Section-columnSection">
                        <header class="Section-header">
                            <strong class="Section-title">Фильтр</strong>
                        </header>
                        <div class="Section-columnContent">
                            <form class="form" action="#" method="post">
                                <div class="form-group">
                                    <div class="range Section-columnRange">
                                        <input class="range-line" id="price" name="price" type="text" data-type="double"
                                               data-min="7" data-max="50" data-from="7" data-to="27"/>
                                        <div class="range-price">Цена:&#32;
                                            <div class="rangePrice"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="form-input form-input_full" id="title" name="title" type="text"
                                           placeholder="Название"/>
                                </div>
                                <div class="form-group">
                                    <select class="form-select">
                                        <option selected="selected" disabled="disabled">Продавец</option>
                                        <option value="kkk">Kkkk</option>
                                        <option value="sdfsdf">sdfsdf</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="toggle">
                                        <input type="checkbox"/><span class="toggle-box"></span><span
                                                class="toggle-text">Только с небитым экраном</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <select class="form-select" multiple size="4">
                                        <option disabled="disabled">Объем памяти</option>
                                        <option>1Гб</option>
                                        <option>2Гб</option>
                                        <option>4Гб</option>
                                        <option>8Гб</option>
                                        <option>многоГб</option>
                                        <option>оченьмногоГб</option>
                                        <option>взвесьтемнеполкилоГб</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="buttons"><a class="btn btn_square btn_dark btn_narrow" href="#">Применить</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="Section-content">
                    <div class="Sort">
                        <div class="Sort-title">Сортировать по:
                        </div>
                        <div class="Sort-variants"><a class="Sort-sortBy Sort-sortBy_dec" href="#">Популярности</a><a
                                    class="Sort-sortBy" href="#">Цене</a><a class="Sort-sortBy" href="#">Отзывам</a><a
                                    class="Sort-sortBy Sort-sortBy_inc" href="#">Новизне</a>
                        </div>
                    </div>

                    <x-catalog.product-list :products="$products" />

                    <div class="Pagination">
                        <div class="Pagination-ins"><a class="Pagination-element Pagination-element_prev" href="#"><img
                                        src="assets/img/icons/prevPagination.svg" alt="prevPagination.svg"/></a><a
                                    class="Pagination-element Pagination-element_current" href="#"><span
                                        class="Pagination-text">1</span></a><a class="Pagination-element" href="#"><span
                                        class="Pagination-text">2</span></a><a class="Pagination-element" href="#"><span
                                        class="Pagination-text">3</span></a><a
                                    class="Pagination-element Pagination-element_prev" href="#"><img
                                        src="assets/img/icons/nextPagination.svg" alt="nextPagination.svg"/></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
