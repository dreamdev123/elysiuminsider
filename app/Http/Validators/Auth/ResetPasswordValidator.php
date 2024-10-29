<?php

namespace App\Http\Validators\Auth;

use App\Http\Validators\ValidationRegex;
use App\Rules\UsersUserNames;
use Illuminate\Http\Request;
use Validator;

class ResetPasswordValidator
{
    /**
     * @return array
     */
    public static function getFields(): array
    {
        return [
            'password' => 'required|string|min:8|max:64|confirmed|regex:' . ValidationRegex::$passwordRegex,
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function validate(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), self::getFields());
    }
}
