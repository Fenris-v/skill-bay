<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\RegisterUserRequest;

class OrderPersonalRequest extends FormRequest
{
    public function rules()
    {
        return array_merge((new RegisterUserRequest())->rules(), ['name' => 'required|min:3|max:255']);
    }
}
