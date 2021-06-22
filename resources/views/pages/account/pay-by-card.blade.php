@php /** @var \App\Models\Order $order */ @endphp

@extends('layouts.layout')

@section('title', __('navigation.order_pay', ['orderId' => $order->id]))

@section('meta_description', '')

@section('middle-header-h1', __('navigation.order_pay', ['orderId' => $order->id]))

@section('content')
    <div class="Section">
        <div class="wrap">
            <form class="form Payment" method="post">
                <div class="Payment-card">
                    <div class="form-group">
                        <label class="form-label">{{ __('orderPage.formElements.pay.cardNumber.label') }}</label>
                        <input class="form-input Payment-bill @error('cardNumber') form-input_error @enderror" name="cardNumber" type="text" placeholder="9999 9999" data-mask="9999 9999" data-validate="require" required>
                        @error('cardNumber')
                        <div class="form-error">{{ $errors->get('cardNumber') }}</div>
                        @enderror
                    </div>
                </div>
                <div class="Payment-pay">
                    @csrf

                    <button class="btn btn_primary" type="submit">
                        {{ __('orderPage.buttons.toPay') }} @price($price)
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
