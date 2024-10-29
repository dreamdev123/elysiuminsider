<?php

namespace App\Http\Validators\Panel\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class AdditionalInformationValidator
{
    public static $estimate_annual_gross_income = ['Less thank $25,000', 'From $25,001 - $50,000', 'From $50,001 - $100,000', 'More than $100,000'];

    public static $net_worth = ['Less thank $100,000', 'From $100,001 - $250,000', 'From $250,001 - $1,000,000', 'More than $1,000,000'];

    public static $income_source = ['Employee Salary', 'Self Employed', 'Investments, Dividends', 'Pension', 'Savings', 'Other Source'];

    public static $education = ['High School', 'Bachelors Degree', 'Masters Degree', 'Doctorate', 'Other'];

    public static $language = ['English', 'Chinese', 'Swedish', 'Spanish', 'Russian'];

    public static $public_position_held = ['Yes', 'No'];

    /**
     * @return array
     */
    public static function getFields(): array
    {
        return [
            'estimate_annual_gross_income' => [
                'required', 'string',
                Rule::in(self::$estimate_annual_gross_income)
            ],
            'net_worth' => [
                'required', 'string',
                Rule::in(self::$net_worth)
            ],
            'income_source' => [
                'required', 'string',
                Rule::in(self::$income_source)
            ],
            'education' => [
                'required', 'string',
                Rule::in(self::$education)
            ],
            'language' => [
                'required', 'string',
                Rule::in(self::$language)
            ],
            'public_position_held' => [
                'required', 'string',
                Rule::in(self::$public_position_held)
            ],
            'public_position_details' => [
                'nullable', 'string', 'max:512'
            ],
        ];
    }

    public function validate(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), self::getFields());
    }
}
