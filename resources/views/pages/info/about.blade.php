@extends('layouts.layout')

@section('title', __('navigation.about'))

@section('middle-header-h1', __('navigation.about'))

@section('content')
    <div class="Section Section_column Section_columnLeft Section_columnWide">
        <div class="wrap">
            <x-aside.advantages :social="true"/>

            <div class="Section-content">
                <article class="Article">
                    <div class="Article-section">
                        <div class="row row_verticalCenter row_maxHalf">
                            <div class="row-block">
                                {!! $configs->getValueBySlug('about_us', '') !!}
                                <div>
                                    <a class="btn btn_primary" href="{{ route('products.index') }}">
                                        {{ __('general.buy_anything') }}
                                    </a>
                                </div>
                            </div>
                            <div class="row-block">
                                <div class="pict">
                                    <img src="{{ asset('assets/img/content/home/slider.png') }}" alt="slider.png"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Article-section">
                        <div class="row row_verticalCenter row_maxHalf">
                            <div class="row-block">
                                <div class="pict">
                                    <img src="{{ asset('assets/img/content/home/bigGoods.png') }}" alt="bigGoods.png"/>
                                </div>
                            </div>
                            <div class="row-block">
                                {!! $configs->getValueBySlug('store_history', '') !!}
                                <div>
                                    <a class="btn btn_primary" href="{{ route('products.index') }}">
                                        {{ __('general.can_i_buy') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
