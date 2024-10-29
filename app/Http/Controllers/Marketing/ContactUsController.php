<?php

namespace App\Http\Controllers\Marketing;


use App\Http\Validators\Marketing\ContactUsValidator;
use App\Mail\ContactUs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Country;

class ContactUsController extends Controller
{
    public function index()
    {
        $countries = Country::where('active', 1)->where('Name', '!=', 'United States')->get();
        
        return view('contact-us')->with(['countries'=>$countries]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function send(Request $request)
    {
        $validateUserChange = new ContactUsValidator();
        $validator = $validateUserChange->validate($request);

        if ($validator->fails()) {
            return redirect(route('marketing::contact-us'))
                ->withErrors($validator->errors())
                ->withInput($request->input());
        }

        $userData = [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'country' => $request->get('country'),
            'gender' => $request->get('gender'),
            'interested' => $request->get('interested'),
            'foundBy' => $request->get('foundBy'),
            'message' => $request->get('message')
        ];

        Mail::to('support@elysiuminsider.io') // TODO: maybe worth to moved to config
        ->send(new ContactUs($userData));

        return redirect(route('marketing::contact-us'))->with([
            'success' => 'Message sent'
        ]);
    }

}
