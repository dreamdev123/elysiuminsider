<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Validators\Auth\RegisterValidator;
use App\Country;
use App\InsiderUser;
use App\User;
use App\UserMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use App\Mail\Welcome;
use App\Mail\Sponsorib;
use Auth;
use Hash;
use Mail;
use GeoIP;
use Carbon\Carbon;

class RegisterController extends Controller
{
    private static $DEFAULT_COUNTRY_ID = 211; // Sweden

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function register(Request $request)
    {
        $validateRegister = new RegisterValidator();
        $validator = $validateRegister->validate($request);

        if ($validator->fails()) {
            return redirect(route('auth::register'))
                ->withErrors($validator->errors())
                ->withInput($request->input());
        }

        // Get GEO
        $country = Country::where([
            'code' => GeoIP::getLocation()->iso_code,
            'active' => true
        ])->first();

        // Check affiliation cookie first - it is most important
        $sponsor_user = null;
        if ($affiliationCookie = \Cookie::get('affiliation_code')) {
            $sponsor_user = User::where('customer_id', $affiliationCookie)->first();
        }

        if (!$sponsor_user && !empty($request->input('affiliate', ''))) {
            $sponsor_user = User::where(['username' => $request->input('affiliate')])->first();
        }

        if (!isset($sponsor_user)) {
            return redirect(route('auth::register'))
                ->withErrors([
                    'message' => trans('auth.sponsor_failed')
                ])
                ->withInput($request->input());
        }

        $sponsor_usermeta = UserMeta::where('user_id', $sponsor_user->id)->first();
        if (strtolower($sponsor_user->email) == strtolower($request->input('email'))) {
            $sponsor_id = $sponsor_user->sponsor_id;
        } else {
            $sponsor_id = $sponsor_user->id;
        }

        // 6 digit random number, unique in DB
        $attempt = 1;
        $attempt_max = 5;
        $customer_id = null;
        do {
            $customer_id = rand(100000,999999);
            $attempt++;
        } while (User::where('customer_id', $customer_id)->exists() && InsiderUser::where('customer_id', $customer_id)->exists() && $attempt <= $attempt_max);

        if ($attempt > $attempt_max) {
            \Log::error("Could not generate unique customer_id");
            abort(500, 'Could not generate unique Customer ID. Please contact Support.');
        }

        // Create Insider user
        $insiderUser = new InsiderUser();
        $insiderUser->customer_id = $customer_id;
        $insiderUser->sponsor_id = $sponsor_user ? $sponsor_id : null;
        $insiderUser->first_name = $request->input('first_name');
        $insiderUser->last_name = $request->input('last_name');
        $insiderUser->email = $request->input('email');
        $insiderUser->status = 'enabled';
        $insiderUser->password = Hash::make($request->input('password'));
        $insiderUser->country = $request->input('country') ? : self::$DEFAULT_COUNTRY_ID;
        $insiderUser->ip = GeoIP::getLocation()->ip;
        $insiderUser->username = $request->input('username');
        $insiderUser->gender = $request->input('gender');
        $insiderUser->mobile_number = $request->input('mobile_number');
        $insiderUser->street_name = $request->input('street_name');
        $insiderUser->house_number = $request->input('house_number');
        $insiderUser->city = $request->input('city');
        $insiderUser->postal_code = $request->input('postal_code');
        $insiderUser->passport_id = $request->input('passport_id');
        $insiderUser->date_of_passport_issuance = $request->input('date_of_passport_issuance');
        $insiderUser->date_of_passport_expiration = $request->input('date_of_passport_expiration');
        $insiderUser->date_of_birth = $request->input('date_of_birth');
        $insiderUser->country_of_birth = $request->input('country_of_birth');
        $insiderUser->country_of_passport_issuance = $request->input('country_of_passport_issuance');
        $insiderUser->nationality = $request->input('country') ? : self::$DEFAULT_COUNTRY_ID;
        $insiderUser->company_name = $request->input('company_name');
        $insiderUser->company_registration_nr = $request->input('company_registration_nr');
        $insiderUser->company_address = $request->input('company_address');
        $insiderUser->company_ubo_director = $request->input('company_ubo_director');
        $insiderUser->expiry_date = $request->input('selectedPackage') == 149 ? Carbon::now()->addMonth(1) : Carbon::now()->addMonth(12) ;
        $insiderUser->state = $request->input('selectedPackage') == 149 ? 'monthly' : 'annual';
        $insiderUser->save();

        // login user
        Auth::login($insiderUser);

        // send email
        
        $data = [];
        $data['user'] = $insiderUser;
        Mail::to($insiderUser->email)
            ->send(new Welcome($data));

        $data['sponsor'] = UserMeta::where('user_id', $insiderUser->sponsor_id)->first();
        $sponsor = User::where('id', $insiderUser->sponsor_id)->first();
        Mail::to($sponsor->email)
            ->send(new Sponsorib($data));

        $id = Auth::id();
        $url = 'https://office.brandfields.com/calcInsiderCommission/';
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Content-Type: application/json"
            )
        ));

        $response = curl_exec($ch);

        $error = curl_error($ch);

        return redirect(route('home'));
    }

    public function verify(Request $request) {
        if ($request->input('key') == 'verifyEmail') {
            return response()->json(['status' => User::where('email', $request->input('value'))->exists()]);
        } else if ($request->input('key') == 'verifyUsername') {
            return response()->json(['status' => User::where('username', $request->input('value'))->exists()]);
        }
    }
}
