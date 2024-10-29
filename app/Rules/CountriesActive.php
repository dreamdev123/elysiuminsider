<?php

namespace App\Rules;

use App\Country;
use Illuminate\Contracts\Validation\Rule;

class CountriesActive implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $country = Country::where([
            'id' => $value,
            'active' => true
        ])->first();

        return $country ? true : false;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'Wrong country id.';
    }
}
