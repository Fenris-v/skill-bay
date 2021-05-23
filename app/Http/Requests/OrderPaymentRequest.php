<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderPaymentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'payment' => 'required|numeric|exists:payment_types,id',
        ];
    }
}
