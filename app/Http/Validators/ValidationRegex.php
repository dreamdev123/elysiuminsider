<?php

namespace App\Http\Validators;

class ValidationRegex
{
    public static $passwordRegex = '/^(?=.*?[a-z])(?=.*?[0-9]).{7,64}$/';
}
