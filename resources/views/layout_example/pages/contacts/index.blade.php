{{--Сравнение товаров--}}
@php
    $breadcrumbs = [
        [
            'name' => 'home',
            'link' => route('index'),
        ],
        [
            'name' => 'Сравнение товаров',
        ],
    ];
@endphp
@extends('layouts.layout')

@section('title', 'Contacts')

@section('meta_description', '')

@section('content')
    @include('layouts.blocks.breadcrumbs.breadcrumbs', ['title' => 'Contact', 'breadcrumbs' => $breadcrumbs])

    <div class="Section Section_column Section_columnRight Section_columnWide">
        <div class="wrap">
            @include('layouts.blocks.advantages')

            <div class="Section-content">
                @include('pages.contacts.map')

                <div class="Contacts Contacts_main">
                    <div class="Contacts-block">
                        <div class="media">
                            <div class="media-image">
                                <img src="/assets/img/icons/contacts/phone.svg" alt="phone.svg"/>
                            </div>
                            <div class="media-content">
                                Phone: +8 (200) 800-2000-600<br>
                                Mobile: +8 (200) 800-2000-650
                            </div>
                        </div>
                    </div>
                    <div class="Contacts-block">
                        <div class="media">
                            <div class="media-image">
                                <img src="/assets/img/icons/contacts/address.svg" alt="address.svg"/>
                            </div>
                            <div class="media-content">
                                Megano Business Center,
                                0012 United States, Los Angeles
                                Creative Street 15/4
                            </div>
                        </div>
                    </div>
                    <div class="Contacts-block">
                        <div class="media">
                            <div class="media-image">
                                <img src="/assets/img/icons/contacts/mail.svg" alt="mail.svg"/>
                            </div>
                            <div class="media-content">
                                General: hello@ninzio.com<br>
                                Editor: editor@ninzio.com
                            </div>
                        </div>
                    </div>
                </div>

                <header class="Section-header Section-header_sm">
                    <h2 class="Section-title">Contact Form</h2>
                </header>

                @include('pages.contacts.callback')
            </div>
        </div>
    </div>
@endsection
