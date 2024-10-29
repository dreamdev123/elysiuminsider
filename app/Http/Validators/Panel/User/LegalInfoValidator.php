<?php

namespace App\Http\Validators\Panel\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class LegalInfoValidator
{
    /**
     * @return array
     */
    public static function getFields(): array
    {
        return [
            'passport_id' => 'required',
            'date_of_birth' => 'required',
            'date_of_passport_issuance' => 'required',
            'date_of_passport_expiration' => 'required',
            'country_of_birth' => 'required',
            'country_of_passport_issuance' => 'required',
            'nationality' => 'required',
        ];
    }

    public function validate(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), self::getFields());
    }
}
