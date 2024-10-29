<?php

namespace App\Http\Validators\Panel\User;

use App\Rules\CountriesActive;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class ProofOfIdentityAndResidenceValidator
{
    /**
     * @return array
     */
    public static function getFields(): array
    {
        return [
            'national_id' => [
                'required', 'image', 'max:1024', 'mimes:jpeg,jpg'
            ],
            'utility_bill' => [
                'required', 'image', 'max:1024', 'mimes:jpeg,jpg'
            ],
        ];
    }

    public function validate(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), self::getFields());
    }
}
