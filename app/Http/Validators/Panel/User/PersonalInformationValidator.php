<?php

namespace App\Http\Validators\Panel\User;

use App\Rules\CountriesActive;
use Illuminate\Http\Request;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use Validator;

class PersonalInformationValidator
{
    /**
     * @return array
     */
    public static function getFields(): array
    {
        return [
            'first_name' => 'required|string|min:3|max:50',
            'last_name' => 'required|string|min:3|max:50',
            'country_id' => [
                'required',
                'int',
                new CountriesActive()
            ],
            'phone' => 'string|max:17',
            'street_address' => 'string|max:100',
            'city' => 'string|max:60',
            'postal_code' => 'string|max:10',
            'state' => 'string|max:64',
            'birth_date' => 'required|date_format:Y-m-d'
        ];
    }

    public function validate(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $validator = Validator::make($request->all(), self::getFields());

        if (!empty($request->get('phone'))) {
            $this->validatePhoneNumber($validator, $request->get('phone'), 'phone');
        }

        return $validator;
    }

    private function validatePhoneNumber($validator, $phoneNumber, $fieldName)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneUtil->parse($phoneNumber, null);
            //$phoneNumberObject = $phoneUtil->parse($phoneNumber, null);
            //$validatedPhoneNumber = $phoneNumberObject->getCountryCode() .$phoneNumberObject->getNationalNumber();
        } catch (NumberParseException $e) {
            $message = $e->getMessage();

            $validator->after(static function ($validator) use ($message, $fieldName) {
                $validator->errors()->add($fieldName, $message);
            });
        }

        return $validator;
    }
}
