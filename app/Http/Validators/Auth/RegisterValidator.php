<?php

namespace App\Http\Validators\Auth;

use App\Http\Validators\ValidationRegex;
use App\Rules\UsersUserNames;
use Illuminate\Http\Request;
use Validator;

class RegisterValidator
{
    /**
     * @return array
     */
    public static function getFields(): array
    {
        return [
            'affiliate' => [
                'required', 'string', 'min:3', 'max:191',
                new UsersUserNames()
            ],
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'email' => 'required|string|email|min:6|max:64|unique:users',
            'password' => 'required|string|min:7|max:64|confirmed',
            'password_confirmation' => 'required|same:password',
            'username' => 'required|string|min:5|max:50|unique:users',
            'gender' => 'required',
            'street_name' => 'required',
            'house_number' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'mobile_number' => 'required',
            'passport_id' => 'required',
            'date_of_birth' => 'required',
            'date_of_passport_issuance' => 'required',
            'date_of_passport_expiration' => 'required',
            'country_of_birth' => 'required',
            'country_of_passport_issuance' => 'required',
        ];
    }

    public function validate(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), self::getFields());
    }
}
