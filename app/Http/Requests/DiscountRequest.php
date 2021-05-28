<?php

namespace App\Http\Requests;

use App\Models\Discount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiscountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'discount.title' => 'required|min:3|max:255',
            'discount.description' => 'required|min:3|max:65535',
            'discount.begin_at' => 'nullable|date_format:Y-m-d|before:discount.end_at',
            'discount.end_at' => 'nullable|date_format:Y-m-d|after:discount.begin_at',
            'discount.value' => 'required|numeric|min:0',
            'discount.unit_type' => [
                Rule::in(array_keys(Discount::unitTypes())),
            ],
            'discount.type' => [
                Rule::in(array_keys(Discount::types())),
            ],
            'discount.priority' => 'required|numeric|min:1|max:999',
            'discount.image_id' => 'required|numeric|exists:attachments,id'
        ];
    }
}
