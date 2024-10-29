<?php

namespace App\Http\Controllers\Panel;

ini_set('max_execution_time', 3200);
set_time_limit(3200);

use App\Http\Controllers\Controller;
use App\InsiderUser;
use App\User;
use App\UserMeta;
use App\UserRepo;
use App\Country;
use App\InsiderMails;
use App\InsiderNews;
use App\InsiderMarketRisks;
use App\Http\Validators\Panel\User\PersonalInfoValidator;
use App\Http\Validators\Panel\User\AccountInfoValidator;
use App\Http\Validators\Panel\User\LegalInfoValidator;
use App\Mail\InsiderAlert;
use App\Services\FileStorageProofService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Exception;
use Hash;
use Mail;
use Ramsey\Uuid\Uuid;
use Torann\GeoIP\Facades\GeoIP;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * @return Factory|View
     */
    public function home()
    {
        $user = Auth::user();
        return view('panel.home')->with(['user'=>$user]);
    }

    public function dailyPriceChart()
    {
        $user = Auth::user();
        return view('panel.dailyPriceChart')->with(['user'=>$user]);
    }

    public function marketEntryRisk()
    {
        $data['user'] = Auth::user();

        $risks = [];
        $insiderMarketRisks = InsiderMarketRisks::whereStatus(1)->orderBy('order', 'asc')->get();

        if (isset($insiderMarketRisks) && count($insiderMarketRisks) > 0) {
            foreach($insiderMarketRisks as $risk) {
                $risks[$risk['name']] = $risk;
            }
        }
        $data['risks'] = $risks;
        $updated_at = InsiderMarketRisks::whereStatus(1)->orderBy('updated_at', 'desc')->first()->updated_at;
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $updated_at, 'CET');
        $data['updated'] = $date->format('d F H:i') . " ". $date->timezone;

        return view('panel.market_entry_risk', $data);
    }

    public function manage_risks()
    {
        $data['user'] = Auth::user();
        if (!isset($data['user']->customer_id) || ($data['user']->customer_id != 888888 && $data['user']->customer_id != 526792)) {
            return redirect()->route('home');
        }

        $risks = [];
        $insiderMarketRisks = InsiderMarketRisks::whereStatus(1)->orderBy('order', 'asc')->get();

        if (isset($insiderMarketRisks) && count($insiderMarketRisks) > 0) {
            foreach($insiderMarketRisks as $risk) {
                $risks[$risk['name']] = $risk;
            }
        }
        $data['risks'] = $risks;

        return view('panel.manageMarketRisk', $data);
    }

    function update_risk_value(Request $request)
    {
        $user = auth()->user();
        $reciepientLists = InsiderUser::where('role_id', 3)->where('expiry_date', '>=', Carbon::today()->format('Y-m-d'))->get();

        if ($request->get('crypto_risks') !== null && count($request->get('crypto_risks')) > 0) {
            foreach($request->get('crypto_risks') as $risk) {
                $marketRisk = InsiderMarketRisks::whereCode($risk['code'])->first();
                if (isset($marketRisk)) {
                    $marketRisk->price = $risk['price'];
                    $marketRisk->percent = $risk['percent'];
                    $marketRisk->push();
                }
            }
            $users = [];
            $phonenumbers = [];

            $username = config('app.bulksms_username');
            $password = config('app.bulksms_password');
            $url = 'https://api.bulksms.com/v1/messages?auto-unicode=true&longMessageMaxParts=30';

            foreach($reciepientLists as $index => $reciepient) {
                $ua = [];
                $ua['email'] = $reciepient->email;
                $ua['name'] = 'Insider Subscriber';
                $users[$index] = (object)$ua;
                $phonenumber = preg_replace(array('/\+/', '/\s/'), '', $reciepient->mobile_number);
                $phonenumber = '+' . $phonenumber;
                array_push($phonenumbers, $phonenumber);

                $messages = array(
                    array('to'=>$phonenumber, 'body'=>'ELYSIUM INSIDER ALERT. Please check your backoffice for Market Entry updates.', 'from'=>'Insider')
                );

                $ch = curl_init( );
                $headers = array(
                'Content-Type:application/json',
                'Authorization:Basic '. base64_encode("$username:$password")
                );
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt ( $ch, CURLOPT_URL, $url );
                curl_setopt ( $ch, CURLOPT_POST, 1 );
                curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt ( $ch, CURLOPT_POSTFIELDS, json_encode($messages) );
                // Allow cUrl functions 20 seconds to execute
                curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
                // Wait 10 seconds while trying to connect
                curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
                $output = array();
                $output['server_response'] = curl_exec( $ch );
                $curl_info = curl_getinfo( $ch );
                $output['http_status'] = $curl_info[ 'http_code' ];
                $output['error'] = curl_error($ch);
                curl_close( $ch );
            }
            $to = array(
                    array(
                        'email' => 'support@elysiuminsider.io',
                        'name' => 'Insider Subscriber'
                    )
                );
            Mail::to($to)->bcc($users)->send(new InsiderAlert($user));

            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function myProfile(Request $request){
        $user = auth()->user();

        return view('panel.user.my_profile')->with([
            'countries' => Country::where([
                'active' => true
            ])->get(),
            'affiliate' => User::where(['id' => $user->sponsor_id])->first()->username,
            'user'=>$user
        ]);
    }

    public function userinfo_update(Request $request){
        
        switch ($request->get('update_type')){
            case 'personalinfo': {
                $validateData = new PersonalInfoValidator();
                $validator = $validateData->validate($request);

                if ($validator->fails()) {
                    return ['success'=>false, 'message'=> $validator->errors()];
                }
                break;
            }
            case 'accountinfo': {
                $validateData = new AccountInfoValidator();
                $validator = $validateData->validate($request);

                if ($validator->fails()) {
                    return ['success'=>false, 'message'=> $validator->errors()];
                }
                break;
            }
            case 'legalinfo': {
                $validateData = new LegalInfoValidator();
                $validator = $validateData->validate($request);

                if ($validator->fails()) {
                    return ['success'=>false, 'message'=> $validator->errors()];
                }
                break;
            }
        }

        if ($request->get('update_type') == 'personalinfo') {
            $user = auth()->user();
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            // $user->email = $request->get('email');
            $user->gender = $request->get('gender');
            $user->house_number = $request->get('house_number');
            $user->street_name = $request->get('street_name');
            $user->city = $request->get('city');
            $user->postal_code = $request->get('postal_code');
            $user->country = $request->get('country');
            $user->mobile_number = $request->get('mobile_number');
            $user->save();
        } elseif ($request->get('update_type') == 'accountinfo') {
            $user = auth()->user();
            $current_password = $request->input('current_password');
            if(!Hash::check($current_password, $user->password))
            {
                return ['success'=>false, 'message'=> array('password'=>array('Your Current password does not matches with the password you provided. Please try again.'))];
            }
            if(strcmp($current_password, $request->input('password')) == 0)
            {
                return ['success'=>false, 'message'=> array('password'=>array('New Password cannot be same as your current password. Please choose a different password.'))];
            }
            // $user->username = $request->input('username');
            $user->password = Hash::make($request->input('password'));
            $user->save();
        } elseif ($request->get('update_type') == 'companyinfo') {
            $user = auth()->user();
            $user->company_name = $request->input('company_name');
            $user->company_registration_nr = $request->input('company_registration_nr');
            $user->company_address = $request->input('company_address');
            $user->company_ubo_director = $request->input('company_ubo_director');
            $user->save();
        } elseif ($request->get('update_type') == 'legalinfo') {
            $user = auth()->user();
            $user->passport_id = $request->get('passport_id');
            $user->date_of_birth = $request->get('date_of_birth');
            $user->date_of_passport_issuance = $request->get('date_of_passport_issuance');
            $user->date_of_passport_expiration = $request->get('date_of_passport_expiration');
            $user->country_of_birth = $request->get('country_of_birth');
            $user->country_of_passport_issuance = $request->get('country_of_passport_issuance');
            $user->nationality = $request->get('nationality');
            $user->save();
        }

        return ['success'=>true];
    }

    public function insider_index(Request $request){
        $user = Auth::user();
        // if ($user->insider)
            return view('panel.user.insider_index')->with(['user'=>$user]);
        // else
            // return redirect()->route('home');
    }

    public function insider_tradingview1(Request $request){
        $user = Auth::user();
        // if ($user->insider)
            return view('panel.user.insider_tradingview1')->with(['user'=>$user]);
        // else
        //     return redirect()->route('home');
    }

    public function insider_tradingview2(Request $request){
        $user = Auth::user();
        // if ($user->insider)
            return view('panel.user.insider_tradingview2')->with(['user'=>$user]);
        // else
        //     return redirect()->route('home');
    }

    public function insider_news(Request $request){
        $user = Auth::user();
        // $office_user_id = User::where('customer_id', $user->customer_id)->orWhere('email', $user->email)->first()->id;
        // if ($user->insider) {
            $details = [];
            // if (isset($office_user_id)) {
                $insiderNews = InsiderNews::where('user_id', $user->customer_id)->orderBy('created_at', 'desc')->get();
                
                if (isset($insiderNews) && count($insiderNews) > 0) {
                    foreach($insiderNews as $news) {
                        $detail['content'] = html_entity_decode($news->insider_mail['content']);
                        
                        $date = Carbon::createFromFormat('Y-m-d H:i:s', $news->insider_mail['created_at'], 'CET');
                        
                        $detail['date'] = $date->format('d F Y, H:i') . " ". $date->timezone;

                        array_push($details, $detail);
                    }
                }
                
                $account_created = Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at, 'CET');
                $welcome_date = $account_created->format('d F Y, H:i') . " ". $date->timezone;
            // }

            return view('panel.user.insider_news')->with(['user'=>$user, 'details'=>json_encode($details), 'welcome_date'=>$welcome_date]);
        // }
        // else {
        //     return redirect()->route('home');
        // }
    }

    public function insider_read_news(Request $request){
        $user = Auth::user();
        $unreadNews = InsiderNews::where('user_id', $user->customer_id)->where('status', 0)->get()->pluck('id')->toArray();
        if (isset($unreadNews) && count($unreadNews)) {
            InsiderNews::whereIn('id', $unreadNews)->update(['status' => 1]);
        }

        return ['success'=>true];
    }
}
