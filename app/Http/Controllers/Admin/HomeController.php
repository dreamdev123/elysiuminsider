<?php

namespace App\Http\Controllers\Admin;

ini_set('max_execution_time', 3200);
set_time_limit(3200);

use App\InsiderUser;
use App\InsiderMarketRisks;
use App\User;
use App\UserMeta;
use App\UserRepo;
use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Carbon\Carbon;
use App\Mail\Welcome;
use App\Mail\Sponsorib;
use Mail;
use GeoIP;

class HomeController extends Controller
{
    //
    public function home($userID = Null) 
    {
    	$userId = $userID ? $userID : Auth::user()->id;
    	$data['user'] = InsiderUser::find($userId);
    	if (!isset($data['user']))
    		$data['user'] = InsiderUser::find(Auth::user()->id);
    	$usermeta = UserMeta::where('user_id', $data['user']->sponsor_id)->first();
    	$data['sponsor'] = $usermeta->firstname . ' ' . $usermeta->lastname;
    	$data['countries'] = Country::where('active', 1)->get();

    	return view('admin.index', $data);
    }

	public	function filter(Request $request)
    {
        $data = InsiderUser::query()
            ->when($keyword = $request->get('keyword'), function ($query) use ($keyword) {
                /** @var Builder $query */
                $query->where(function ($query) use ($keyword) {
                    /** @var Builder $query */
                    $query->whereRaw('concat(username," ",email," ",first_name," ",last_name) LIKE ?', "%{$keyword}%");
                });
            })
            ->when($memberId = $request->get('memberId'), function ($query) use ($memberId) {
                /** @var Builder $query */
                $query->where(function ($query) use ($memberId) {
                    /** @var Builder $query */
                    $query->whereRaw('concat(customer_id) LIKE ?', "%{$memberId}%");
                });
            })
            ->get();

        return response()->json($data);
    }

    public function profile(Request $request)
    {
        $data['user'] = Auth::user();
        $data['countries'] = Country::where('active', 1)->get();
        return view('admin.index', $data);
    }

    //
    function profileUsername(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:5|unique:insider_users,username,' . $request->get('userId') . ',id',
        ]);
        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()]);

        $user = InsiderUser::find($request->get('userId'));
        $user->username = $request->get('username');
        $user->push();

        return response()->json(['status' => true]);
    }

    //
    function profileSponsorId(Request $request)
    {
        $sponsor = User::where('customer_id', $request->get('sponsor_customer_id'))->first();
        if (!isset($sponsor))
            return response()->json(['status' => false, 'message' => ['Sponsor id' => ['No Sponsor!']]]);

        $user = InsiderUser::find($request->get('userId'));
        $user->sponsor_id = $sponsor->id;
        $user->push();
        
        return response()->json(['status' => true]);
    }

    //
    function profileProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'passport_id' => 'required',
            'gender' => 'required',
            'nationality' => 'required',
            'country_of_birth' => 'required',
            'date_of_passport_issuance' => 'required',
            'date_of_passport_expiration' => 'required',
            'country_of_passport_issuance' => 'required',
            'email' => 'required|string|email|min:6|max:64|unique:insider_users,email,' . $request->get('userId') . ',id',
            'mobile_number' => 'required',
            'street_name' => 'required',
            'house_number' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'city' => 'required',
        ]);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()]);

        $user = InsiderUser::find($request->get('userId'));

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->country = $request->input('country') ? : self::$DEFAULT_COUNTRY_ID;
        $user->gender = $request->input('gender');
        $user->mobile_number = $request->input('mobile_number');
        $user->street_name = $request->input('street_name');
        $user->house_number =$request->input('house_number');
        $user->city = $request->input('city');
        $user->postal_code = $request->input('postal_code');
        $user->passport_id = $request->input('passport_id');
        $user->date_of_passport_issuance = $request->input('date_of_passport_issuance');
        $user->date_of_passport_expiration = $request->input('date_of_passport_expiration');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->country_of_birth = $request->input('country_of_birth');
        $user->country_of_passport_issuance = $request->input('country_of_passport_issuance');
        $user->nationality = $request->input('nationality') ? : self::$DEFAULT_COUNTRY_ID;
        $user->company_name = $request->input('company_name');
        $user->company_registration_nr = $request->input('company_registration_nr');
        $user->company_address = $request->input('company_address');
        $user->company_ubo_director = $request->input('company_ubo_director');
        $user->push();

        return response()->json(['status' => true]);
    }

    //
    function profilePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:5|max:64|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()]);

        $user = InsiderUser::find($request->get('userId'));
        $user->password = Hash::make($request->input('password'));
        $user->push();

        return response()->json(['status' => true]);
    }

    //
    function profileNotes(Request $request)
    {
        $user = InsiderUser::find($request->get('userId'));
        $user->notes = $request->input('notes');
        $user->push();

        return response()->json(['status' => true]);
    }

    public function send_mail($clientID = Null) 
    {
        if (!isset($clientID)) {
            echo 'You didn\'t input the Client ID';
        } else {
            $user = InsiderUser::where('customer_id', $clientID)->first();
            $data = [];
            $data['user'] = $user;
            Mail::to($user->email)
                ->send(new Welcome($data));

            $data = [];
            $data['user'] = $user;
            $data['sponsor'] = UserMeta::where('user_id', $user->sponsor_id)->first();
            $sponsor = User::where('id', $user->sponsor_id)->first();
            Mail::to($sponsor->email)
                ->send(new Sponsorib($data));
            echo 'Success send mail';
        }
    }

    public function equities()
    {
        $data['user'] = Auth::user();
        $data['countries'] = Country::where('active', 1)->get();
        
        return view('admin.equities', $data);
    }

    public function market_entry_risk()
    {
        $data['user'] = Auth::user();

        $risks = [];
        $insiderMarketRisks = InsiderMarketRisks::all();

        if (isset($insiderMarketRisks) && count($insiderMarketRisks) > 0) {
            foreach($insiderMarketRisks as $risk) {
                $risks[$risk['name']] = $risk;
            }
        }
        $data['risks'] = $risks;

        return view('admin.manage_market_entry', $data);
    }

    function update_risk_value(Request $request)
    {
        $marketRisk = InsiderMarketRisks::whereCode($request->get('code'))->first();

        if ($request->get('prefix') == "price")
            $marketRisk->price = $request->get('price');
        else
            $marketRisk->percent = $request->get('percent');
        $marketRisk->push();

        return response()->json(['status' => true]);
    }
}
