<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderDeliveryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'city' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'delivery' => 'required|numeric|exists:delivery_types,id',
        ];
    }
}
