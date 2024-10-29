<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;

class LegalController extends Controller
{

    public function gdpr()
    {
        return view('legal.gdpr');
    }

    public function termsOfService()
    {
        return view('legal.terms-of-service');
    }

    public function termsOfUse()
    {
        return view('legal.terms-of-use');
    }

}
