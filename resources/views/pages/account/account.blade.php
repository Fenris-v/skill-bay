@extends('layouts.layout')

@section('title', 'История просмотра')

@section('meta_description', '')

@section('middle-header-h1', __('navigation.account'))

@section('content')
    <div class="Section Section_column Section_columnLeft">
        <div class="wrap">
            @include('pages.account.aside')

            <div class="Section-content">
                <div class="Account">
                    <div class="Account-group">
                        <div class="Account-column">
                            <div class="Account-avatar">
                            @if($user->attachment != null) 
                                <img src="{{$user->attachment->name}}" alt="avatar"/>
                            @endif
                            </div>
                        </div>
                        <div class="Account-column">
                            <div class="Account-name">
                                {{ $user->name }}
                            </div>
                            <a class="Account-editLink" href="{{ route('profile') }}">
                                {{ __('navigation.edit_profile') }}
                            </a>
                        </div>
                    </div>

                    @if($order)
                        <div class="Account-group">
                            <div class="Account-column Account-column_full">
                                <x-account.order-item :order="$order"/>
                            </div>
                        </div>
                    @endif

                    <div class="Account-group">
                        <div class="Account-column Account-column_full">
                            <header class="Section-header">
                                <h2 class="Section-title">
                                    {{ __('navigation.history') }}
                                </h2>
                            </header>

                            <x-catalog.product-list :products="$history" class="Cards_account" />

                            <div class="Account-editLink Account-editLink_view">
                                <a href="{{ route('viewed_history') }}">
                                    {{ __('navigation.go_to_history') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
