<?php

namespace App\Http\Controllers\Auth;

use App\InsiderUser;
use App\InsiderUserPasswordResets;
use App\Http\Controllers\Controller;
use App\Http\Validators\Auth\ForgotPasswordValidator;
use App\Http\Validators\Auth\ResetPasswordValidator;
use App\Mail\PasswordReset;
use GeoIP;
use Hash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mail;
use Ramsey\Uuid\Uuid;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    private static $RESET_LINK_EXPIRATION_MINUTES = 60;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @return Factory|View
     */
    public function showPasswordForgotForm()
    {
        return view('auth.password-forgot');
    }

    public function sendPasswordForgotLink(Request $request)
    {
        $validateLogin = new ForgotPasswordValidator();
        $validator = $validateLogin->validate($request);

        if ($validator->fails()) {
            return redirect(route('auth::password-forgot'))
                ->withErrors($validator->errors())
                ->withInput($request->input());
        }

        // check if email match with active user
        $user = InsiderUser::where(['email' => $request->get('email'), 'status' => 'enabled'])->first();

        // TODO: send link, form with link passord+confimr
        if ($user) {
            $uuid4 = Uuid::uuid4();
            $token = $uuid4->toString();

            $resetPassword = new InsiderUserPasswordResets();
            $resetPassword->insider_user_id = $user->id;
            $resetPassword->token = $token;
            $resetPassword->generated_ip = GeoIP::getLocation()->ip;
            $resetPassword->save();

            // send email
            Mail::to($request->get('email'))
                ->send(new PasswordReset($user, route('auth::password-reset', ['token' => $token])));
        }


        // even user dos not exist show that we sent message
        return redirect(route('auth::password-forgot'))->with([
            'resetLinkSent' => true
        ]);
    }

    public function showResetForm(string $token)
    {
        $checkTokenForUser = $this->checkToken($token);

        // not valid token
        if (!$checkTokenForUser) {
            return redirect(route('home'));
        }

        return view('auth.password-reset')->with([
            'user' => InsiderUser::find($checkTokenForUser->insider_user_id),
            'token' => $token
        ]);
    }

    /**
     * @param $token
     * @return Builder|Model|object|null
     */
    private function checkToken(string $token)
    {
        return InsiderUserPasswordResets::where([
            'token' => $token,
            'used_at' => null
        ])->where('created_at', '>', now()->subMinutes(self::$RESET_LINK_EXPIRATION_MINUTES)->toDateTimeString())
            ->first();
    }

    public function reset(Request $request, $token)
    {
        $checkTokenForUser = $this->checkToken($token);

        // not valid token
        if (!$checkTokenForUser) {
            return redirect(route('home'));
        }

        // validate form data
        $validateLogin = new ResetPasswordValidator();
        $validator = $validateLogin->validate($request);

        if ($validator->fails()) {
            return redirect(route('auth::password-reset', ['token' => $token]))
                ->withErrors($validator->errors())
                ->withInput($request->input());
        }

        // chcange user password
        $user = InsiderUser::find($checkTokenForUser->insider_user_id);
        $user->password = Hash::make($request->get('password'));
        $user->update();

        // update password resets record
        $checkTokenForUser->update([
            'used_ip' => GeoIP::getLocation()->ip,
            'used_at' => now()
        ]);

        return redirect(route('auth::login'))->with([
            'passwordChanded' => true
        ]);
    }
}
