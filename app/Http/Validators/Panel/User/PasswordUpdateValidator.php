<?php

namespace App\Http\Validators\Panel\User;

use Auth;
use Hash;
use Illuminate\Http\Request;
use Validator;
use App\Http\Validators\ValidationRegex;

class PasswordUpdateValidator
{
    /**
     * @return array
     */
    public static function getFields(): array
    {
        return [
            'current_password' => [
                'required',
                'min:8',
                'max:64',
                static function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'password' => 'required|string|min:8|max:64|confirmed|regex:' . ValidationRegex::$passwordRegex,
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function validate(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), self::getFields());
    }
}
