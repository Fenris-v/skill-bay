@extends('layouts.layout')

@section('title', __('navigation.contacts'))

@section('middle-header-h1', __('navigation.contacts'))

@section('content')
    <div class="Section Section_column Section_columnRight Section_columnWide">
        <div class="wrap">
            <x-aside.advantages :social="true"/>

            <div class="Section-content">
                <div class="Map">
                    <script type="text/javascript" charset="utf-8" async
                            src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Aab0c930ee3de165a0eaa7eab3c5e810a0019bf38d9c3e3b44ca793b8ba10aad9&amp;amp;width=100%25&amp;amp;height=486&amp;amp;lang=ru_RU&amp;amp;scroll=true"></script>
                </div>

                <div class="Contacts Contacts_main">
                    <div class="Contacts-block">
                        <div class="media">
                            <div class="media-image">
                                <x-icons.contacts.phone />
                            </div>
                            <div class="media-content">
                                {{ __('general.phone') }}: {{ $configs->getPhone() }}
                            </div>
                        </div>
                    </div>

                    <div class="Contacts-block">
                        <div class="media">
                            <div class="media-image">
                                <x-icons.contacts.address />
                            </div>
                            <div class="media-content">
                                {{ $configs->getFullAddress() }}
                            </div>
                        </div>
                    </div>

                    <div class="Contacts-block">
                        <div class="media">
                            <div class="media-image">
                                <x-icons.contacts.mail />
                            </div>
                            <div class="media-content">
                                {{ __('general.email') }}: {{ $configs->getEmail() }}
                            </div>
                        </div>
                    </div>
                </div>

                <header class="Section-header Section-header_sm">
                    <h2 class="Section-title">{{ __('general.callback') }}</h2>
                </header>

                @if(session()->has('callback'))
                    <div class="green">
                        <p>{{ session('callback') }}</p>
                    </div>
                @endif
                <form class="form form_contacts" action="{{ route('contacts') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <div class="row">
                            <div class="row-block">
                                <input class="form-input" id="name" name="name" type="text"
                                       placeholder="{{ __('general.your_name') }}" value="{{ old('name') }}"/>

                                @if($errors->first('name'))
                                    <div class="danger">
                                        <p>{{ $errors->first('name') }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="row-block">
                                <input class="form-input" id="mail" name="email" type="text"
                                       placeholder="{{ __('general.your_email') }}" value="{{ old('email') }}"/>

                                @if($errors->first('email'))
                                    <div class="danger">
                                        <p>{{ $errors->first('email') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-textarea" name="message" id="message"
                                  placeholder="{{ __('general.message') }}">{{ old('message') }}</textarea>

                        @if($errors->first('message'))
                            <div class="danger">
                                <p>{{ $errors->first('message') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input class="btn btn_muted form-btn" type="submit" value="{{ __('general.submit') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
