<?php

namespace App\Http\Validators\Panel\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class AccountInformationValidator
{
    public static $account_type = ['Premium', 'Standard'];

    public static $currency = ['EUR', 'GBP', 'USD'];

    public static $platform = ['Y'];

    public static $client = ['individual_trader', 'money_manager', 'introducing_broker'];

    public static $purpose = ['Hedging', 'Risk management', 'Intraday Trading', 'Other'];

    public static $avarge_trading_volume = ['Up to $50,000', 'From $50,0001 - $250,000', 'From $250,0001 - $1,000,000', 'From $1,000,001 - $5,000,000', 'More than $5,000,001'];

    public static $leverage = ['1:1', '1:10', '1:50', '1:100'];

    public static $experience_years = ['None', 'Up to 1 year', '1 -3 years', '3 - 5 years', '5 - 10 years', 'More than 10 years'];

    public static $trading_frequency = ['Less than 5 trades', '6 - 20 trades', '21 - 50 trades', 'More than 50 trades'];
    /**
     * @return array
     */
    public static function getFields(): array
    {
        return [
            'account_type' => [
                'required', 'string',
                Rule::in(self::$account_type)
            ],
            'currency' => [
                'required', 'string',
                Rule::in(self::$currency)
            ],
            'platform' => [
                'required', 'string',
                Rule::in(self::$platform)
            ],
            'client' => [
                'required', 'string',
                Rule::in(self::$client)
            ],
            'purpose' => [
                'required', 'string',
                Rule::in(self::$purpose)
            ],
            'avarge_trading_volume' => [
                'required', 'string',
                Rule::in(self::$avarge_trading_volume)
            ],
            'leverage' => [
                'required', 'string',
                Rule::in(self::$leverage)
            ],
            'experience_years' => [
                'required', 'string',
                Rule::in(self::$experience_years)
            ],
            'trading_frequency' => [
                'required', 'string',
                Rule::in(self::$trading_frequency)
            ],
        ];
    }

    public function validate(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($request->all(), self::getFields());
    }
}
