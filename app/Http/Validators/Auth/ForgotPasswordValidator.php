<?php

namespace App\Http\Validators\Auth;

use Illuminate\Http\Request;
use Validator;

class ForgotPasswordValidator
{
    /**
     * @return array
     */
    public static function getFields(): array
    {
        return [
            'email' => 'required|string|email|min:6|max:64'
        ];
    }

    public function validate(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), self::getFields());
    }
}
