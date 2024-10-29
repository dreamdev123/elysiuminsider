<?php

namespace App\Http\Validators\Auth;

use Illuminate\Http\Request;
use Validator;

class LoginValidator
{
    /**
     * @return array
     */
    public static function getFields(): array
    {
        return [
            'username' => 'required|string|min:5|max:64',
            'password' => 'required|string|min:1|max:64|',
            'remember' => 'string'
        ];
    }

    public function validate(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), self::getFields());
    }
}
