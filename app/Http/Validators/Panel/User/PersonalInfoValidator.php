<?php

namespace App\Http\Validators\Panel\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class PersonalInfoValidator
{
    /**
     * @return array
     */
    public static function getFields(): array
    {
        return [
            'first_name' => 'required|string|min:3|max:50',
            'last_name' => 'required|string|min:3|max:50',
            // 'email' => 'required|email|min:6|unique:insider_users,email,' . Auth::user()->id . ',id',
            'gender' => 'required',
            'street_name' => 'required',
            'house_number' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'mobile_number' => 'required',
        ];
    }

    public function validate(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), self::getFields());
    }
}
