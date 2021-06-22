<?php

namespace App\Http\Requests;

use App\Models\Discount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Orchid\Layouts\Discount\ProductTypeDiscountLayout;
use App\Orchid\Layouts\Discount\GroupTypeDiscountLayout;
use App\Orchid\Layouts\Discount\CartTypeDiscountLayout;

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
                Rule::in(Discount::unitTypes()),
            ],
            'discount.type' => [
                Rule::in(collect(Discount::types())->map(fn($item) => (string) $item)),
            ],
            'discount.priority' => 'required|numeric|min:1|max:999',
            'discount.image_id' => 'required|numeric|exists:attachments,id',
            'discount.discountUnit' => [
                'required_unless:discount.type,' . Discount::CART,
                'array',
            ],
            'discount.discountUnit.*.products' => [
                'required_without_all:discount.discountUnit.*.categories',
                'array'
            ],
            'discount.discountUnit.*.products.*' => 'numeric|exists:products,id',
            'discount.discountUnit.*.categories' => [
                'required_without_all:discount.discountUnit.*.products',
                'array',
            ],
            'discount.discountUnit.*.categories.*' => 'numeric|exists:categories,id',
            'discount.conditions' => [
                'required_if:discount.type,' . Discount::CART,
                'array',
            ],
            'discount.conditions.max_price' => 'numeric|min:1|required_without_all:discount.conditions.min_price,discount.conditions.max_amount,discount.conditions.min_amount',
            'discount.conditions.min_price' => 'numeric|min:1|required_without_all:discount.conditions.max_price,discount.conditions.max_amount,discount.conditions.min_amount',
            'discount.conditions.max_amount' => 'numeric|min:1|required_without_all:discount.conditions.max_price,discount.conditions.min_price,discount.conditions.min_amount',
            'discount.conditions.min_amount' => 'numeric|min:1|required_without_all:discount.conditions.max_price,discount.conditions.min_price,discount.conditions.max_amount',
        ];
    }

    public function all($keys = null)
    {
        $attributes = parent::all();
        $attributes['discount']['conditions'] = collect($attributes['discount']['conditions'])
            ->reduceWithKeys(
                function ($accum, $value, $key) {
                    if ($value !== null) {
                        $accum[$key] = $value;
                    }
                    return $accum;
                },
                []
            )
        ;

        $this->replace($attributes);

        return parent::all();
    }
}
