<?php

namespace App\Console\Commands;

use App\InsiderUser;
use App\User;
use App\UserMeta;
use App\UserRepo;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Log;
use RuntimeException;
use GeoIP;
use Carbon\Carbon;

class MoveUsersToInsiderUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:move_users_to_insider_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add insider_user_from_users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $key => $user) {
            if (isset($user->customer_id) && $user->customer_id != 0 && isset($user->sponsor_id) && $user->sponsor_id != 0 && $user->package_id > 1) {
                $insider_user = InsiderUser::where('email', $user->email)->orWhere('customer_id', $user->customer_id)->first();
                if (!isset($insider_user)) {
                    $usermeta = UserMeta::where('user_id', $user->id)->first();
                    $userRepo = UserRepo::where('user_id', $user->id)->first();
                    if (isset($usermeta) && isset($userRepo)) {
                        $insiderUser = new InsiderUser();
                        $insiderUser->customer_id = $user->customer_id;
                        $insiderUser->sponsor_id = $userRepo->sponsor_id;
                        $insiderUser->username = $user->username;
                        $insiderUser->first_name = $usermeta->firstname;
                        $insiderUser->last_name = $usermeta->lastname;
                        $insiderUser->email = $user->email;
                        $insiderUser->password = $user->password;
                        $insiderUser->status = 'enabled';
                        $insiderUser->gender = $usermeta->gender;
                        $insiderUser->mobile_number = $user->phone;
                        $insiderUser->street_name = $usermeta->street_name;
                        $insiderUser->house_number = $usermeta->house_no;
                        $insiderUser->country = $usermeta->country_id;
                        $insiderUser->city = $usermeta->city;
                        $insiderUser->postal_code = $usermeta->postcode;
                        $insiderUser->passport_id = $usermeta->passport_no;
                        $insiderUser->date_of_passport_issuance = $usermeta->date_of_passport_issuance;
                        $insiderUser->date_of_passport_expiration = $usermeta->passport_expirition_date;
                        $insiderUser->date_of_birth = $usermeta->dob;
                        $insiderUser->country_of_birth = $usermeta->place_of_birth;
                        $insiderUser->country_of_passport_issuance = $usermeta->country_of_passport_issuance;
                        $insiderUser->nationality = $usermeta->nationality;
                        $insiderUser->ip = GeoIP::getLocation()->ip;
                        $insiderUser->expiry_date = $user->expiry_date;
                        $insiderUser->save();
                    }
                } else {
                    $today = date('Y-m-d');
                    if (strtotime($user->expiry_date) > strtotime($today)) {
                        if(!isset($insider_user->expiry_date) || strtotime($insider_user->expiry_date) < strtotime($user->expiry_date)) {
                            $insider_user->expiry_date = $user->expiry_date;
                            $insider_user->save();
                        }
                    }
                }
            }
        }
    }
}
