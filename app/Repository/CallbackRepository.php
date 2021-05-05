<?php

namespace App\Repository;

use App\Models\Callback;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Validation\ValidationException;

class CallbackRepository
{
    use ValidatesRequests;

    /**
     * @param $request
     * @throws ValidationException
     */
    public function createCallback($request): void
    {
        $result = $this->validate($request, [
            'name' => 'required|min:3|max:250',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Callback::create($result);
    }
}
