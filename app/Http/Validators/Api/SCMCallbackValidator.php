<?php

namespace App\Http\Validators\Api;

use Illuminate\Http\Request;
use Validator;

class SCMCallbackValidator
{
    /**
     * @return array
     */
    public static function getFields(): array
    {
        return [
            'payload' => 'required|max:6666|json',
        ];
    }

    public function validate(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), self::getFields());
    }
}
