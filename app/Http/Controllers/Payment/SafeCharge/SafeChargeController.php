<?php

namespace App\Http\Controllers\Payment\SafeCharge;

use App\Http\Controllers\Controller;
use App\Http\Validators\Auth\RegisterValidator;
use App\Country;
use App\InsiderUser;
use App\User;
use App\UserMeta;
use App\SafeChargeTransaction;
use App\SafeChargeHistory;
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
use SafeCharge\Api\RestClient;
use SafeCharge\Tests\SimpleData;  
use SafeCharge\Tests\TestCaseHelper;
use SafeCharge\Api\Exception\ResponseException;
use SafeCharge\Api\Exception\ConnectionException;
use SafeCharge\Api\Exception\SafeChargeException;
use SafeCharge\Api\Exception\ValidationException;
use SafeCharge\Api\Exception\ConfigurationException;
use SafeCharge\Api\Utils;
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/TestCaseHelper.php';

class SafeChargeController extends Controller
{
    private static $DEFAULT_COUNTRY_ID = 211; // Sweden

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function register_pay(Request $request)
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

        $userInfo = array('sponsor_id' => $sponsor_user ? $sponsor_id : null, 'first_name' => $request->input('first_name'), 'last_name' => $request->input('last_name'), 'email' => $request->input('email'), 'password' => Hash::make($request->input('password')), 'country' => $request->input('country') ? : self::$DEFAULT_COUNTRY_ID, 'ip' => GeoIP::getLocation()->ip, 'username' => $request->input('username'), 'gender' => $request->input('gender'), 'mobile_number' => $request->input('mobile_number'), 'street_name' => $request->input('street_name'), 'house_number' => $request->input('house_number'), 'city' => $request->input('city'), 'postal_code' => $request->input('postal_code'), 'passport_id' => $request->input('passport_id'), 'date_of_passport_issuance' => $request->input('date_of_passport_issuance'), 'date_of_passport_expiration' => $request->input('date_of_passport_expiration'), 'date_of_birth' => $request->input('date_of_birth'), 'country_of_birth' => $request->input('country_of_birth'), 'country_of_passport_issuance' => $request->input('country_of_passport_issuance'), 'nationality' => $request->input('country') ? : self::$DEFAULT_COUNTRY_ID, 'company_name' => $request->input('company_name'), 'company_registration_nr' => $request->input('company_registration_nr'), 'company_address' => $request->input('company_address'), 'company_ubo_director' => $request->input('company_ubo_director'));

        $productid = uniqid('product_');

        $amount = $request->input('selectedPackage');
        
        SafeChargeTransaction::create([
            "address" => $productid,
            "callback" => '',
            "amount" => $amount,
            "context" => 'Registration Insider',
            "data" => $userInfo,
            "status" => 0
        ]);

        $config = [
            'environment'       => \SafeCharge\Api\Environment::TEST,
            'merchantId'        => env("merchant_id", "3066848571833206816"),
            'merchantSiteId'    => env("merchant_site_id", "190398"),
            'merchantSecretKey' => env("merchant_secret_key", "fPUU9lVPB1YgtkAUbAkuTSY1IpJqPHrzawPB68cqMJl3itwJQVM355d4Wbj5rsNi"),
            'hashAlgorithm'     => 'sha256'
        ];

        $checksumParametersOrder = ['merchantId', 'merchantSiteId', 'clientRequestId', 'amount', 'currency', 'timeStamp', 'merchantSecretKey'];

        $params = ['merchantId'=>$config['merchantId'],'merchantSiteId'=>$config['merchantSiteId'],'amount'=>$request->input('selectedPackage'),'currency'=>'EUR','timeStamp'=>date('Y-m-d H:m:s')];

        $date = date('Y-m-d H:m:s');
        $success_url = route('auth::register.safecharge.success');
        $callback_url = route('safecharge.callback');
        $cancel_url = route('safecharge.cancel');
        $theme_id = 176896;
        $checksumstring = "";

        $checksumstring = $config['merchantSecretKey'] .$config['merchantSiteId'] . $config['merchantId'] . 'EUR' . $amount . $productid . $amount . '1' . $date . '4.0.0' . $callback_url . $success_url . $theme_id . $productid;

        $checksum = hash('sha256',$checksumstring);

        return redirect('https://secure.safecharge.com/ppp/purchase.do?merchant_site_id=' . $config['merchantSiteId'] .'&merchant_id=' . $config['merchantId'] . '&currency=EUR&total_amount=' . $amount . '&item_name_1=' . $productid . '&item_amount_1=' . $amount . '&item_quantity_1=1&time_stamp=' . $date . '&version=4.0.0'. '&notify_url=' . $callback_url . '&checksum=' . $checksum . '&success_url=' . $success_url . '&&theme_id=176896' . '&userid=' . $productid);
    }

    function register_pay_success(Request $request) {
        if(isset($_GET['productId']))
        {
            $product = $_GET['productId'];

            if($_GET['Status'] == 'APPROVED')
            {
                $this->createuser($product);
                $id = Auth::id();

                $url = 'https://office.elysiumnetwork.io/calcInsiderCommission/';
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
        }
    }

    function createuser($productid)
    {
       
        if(!isset($productid))
        {
            return false;
        }

        $SafeChargetransaction = SafeChargeTransaction::where(['address' => $productid, 'status' => 0])->first();

        DB::transaction(function () use ($productid, $SafeChargetransaction) {

            if ( $SafeChargetransaction && !$SafeChargetransaction->status ) {

                SafeChargeTransaction::where('address', $productid)->update(['status' => 1]);

                $userentry = false;
                if($SafeChargetransaction->context == 'Registration Insider')
                {
                    $userentry = InsiderUser::where(['username' => $SafeChargetransaction->data['username']])->first();    
                }
                
                if(!$userentry)
                {
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

                    // Create user
                    $insiderUser = new InsiderUser();
                    $insiderUser->customer_id = $customer_id;
                    $insiderUser->sponsor_id = $SafeChargetransaction->data['sponsor_id'];
                    $insiderUser->first_name = $SafeChargetransaction->data['first_name'];
                    $insiderUser->last_name = $SafeChargetransaction->data['last_name'];
                    $insiderUser->email = $SafeChargetransaction->data['email'];
                    $insiderUser->status = 'enabled';
                    $insiderUser->password = $SafeChargetransaction->data['password'];
                    $insiderUser->country = $SafeChargetransaction->data['country'];
                    $insiderUser->ip = $SafeChargetransaction->data['ip'];
                    $insiderUser->username = $SafeChargetransaction->data['username'];
                    $insiderUser->gender = $SafeChargetransaction->data['gender'];
                    $insiderUser->mobile_number = $SafeChargetransaction->data['mobile_number'];
                    $insiderUser->street_name = $SafeChargetransaction->data['street_name'];
                    $insiderUser->house_number = $SafeChargetransaction->data['street_name'];
                    $insiderUser->city = $SafeChargetransaction->data['city'];
                    $insiderUser->postal_code = $SafeChargetransaction->data['postal_code'];
                    $insiderUser->passport_id = $SafeChargetransaction->data['passport_id'];
                    $insiderUser->date_of_passport_issuance = $SafeChargetransaction->data['date_of_passport_issuance'];
                    $insiderUser->date_of_passport_expiration = $SafeChargetransaction->data['date_of_passport_expiration'];
                    $insiderUser->date_of_birth = $SafeChargetransaction->data['date_of_birth'];
                    $insiderUser->country_of_birth = $SafeChargetransaction->data['country_of_birth'];
                    $insiderUser->country_of_passport_issuance = $SafeChargetransaction->data['country_of_passport_issuance'];
                    $insiderUser->nationality = $SafeChargetransaction->data['nationality'];
                    $insiderUser->company_name = $SafeChargetransaction->data['company_name'];
                    $insiderUser->company_registration_nr = $SafeChargetransaction->data['company_registration_nr'];
                    $insiderUser->company_address = $SafeChargetransaction->data['company_address'];
                    $insiderUser->company_ubo_director = $SafeChargetransaction->data['company_ubo_director'];
                    $insiderUser->expiry_date = ($SafeChargetransaction->amount == 149 || $SafeChargetransaction->amount == 99) ? Carbon::now()->addMonth(1) : Carbon::now()->addMonth(12) ;
                    $insiderUser->state = ($SafeChargetransaction->amount == 149 || $SafeChargetransaction->amount == 99) ? 'monthly' : 'annual';
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
                }
            }
        });
    }

    function callback(Request $request) {
        $postdata = file_get_contents('php://input');

        SafeChargeHistory::create([
            'getParams' => $_GET,
            'postParams' => $postdata,
        ]);

        return ['success'=>true];
    }

    function cancel(Request $request) {
        $data_array = [
            'error'=>$request->input('error')
        ];
        return view('payment.safecharge.cancel', $data_array)->render();
    }

    function error(Request $request) {
        $data_array = [
            'error'=>$request->input('error')
        ];
        return view('payment.safecharge.error', $data_array)->render();
    }
}
