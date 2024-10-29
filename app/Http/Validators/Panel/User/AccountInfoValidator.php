<?php

namespace App\Http\Validators\Panel\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class AccountInfoValidator
{
    /**
     * @return array
     */
    public static function getFields(): array
    {
        return [
            'password' => 'required|string|min:7|max:64|confirmed',
            'password_confirmation' => 'required|same:password',
            // 'username' => 'required|min:5|unique:capital_users,username,' . Auth::user()->id . ',id',
        ];
    }

    public function validate(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), self::getFields());
    }
}
