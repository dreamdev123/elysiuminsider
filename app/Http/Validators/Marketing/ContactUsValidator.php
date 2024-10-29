<?php

namespace App\Http\Validators\Marketing;

use Illuminate\Http\Request;
use Validator;

class ContactUsValidator
{
    /**
     * @return array
     */
    public static function getFields(): array
    {
        return [
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'email' => 'required|string|email|min:6|max:128',
            'phone' => 'required|string|max:17',
            'message' => 'required|string|min:8|max:512',
        ];
    }

    public function validate(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), self::getFields());
    }
}
