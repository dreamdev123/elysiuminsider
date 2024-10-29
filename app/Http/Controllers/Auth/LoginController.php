<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Validators\Auth\LoginValidator;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\InsiderUser;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function adminLogin()
    {
        return view('auth.adminLogin');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function loginSent(Request $request)
    {
        $validateLogin = new LoginValidator();
        $validator = $validateLogin->validate($request);

        if ($validator->fails()) {
            return redirect(route('auth::login'))
                ->withErrors($validator->errors())
                ->withInput($request->input());
        }

        $remember = $request->has('remember') ? true : false;

        $authorize = Auth::attempt(['username' => $request->get('username'), 'password' => $request->get('password'), 'status' => 'enabled', 'role_id' => 3], $remember);

        if (!$authorize) {
            return redirect(route('auth::login'))
                ->withErrors([
                    'message' => trans('auth.failed')
                ])
                ->withInput($request->input());
        }

        return redirect(route('home'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function adminLoginSent(Request $request)
    {
        $validateLogin = new LoginValidator();
        $validator = $validateLogin->validate($request);

        if ($validator->fails()) {
            return redirect(route('auth::admin-login'))
                ->withErrors($validator->errors())
                ->withInput($request->input());
        }

        $remember = $request->has('remember') ? true : false;

        $authorize = Auth::attempt(['username' => $request->get('username'), 'password' => $request->get('password'), 'status' => 'enabled', 'role_id' => 2], $remember);

        if (!$authorize) {
            return redirect(route('auth::admin-login'))
                ->withErrors([
                    'message' => trans('auth.admin_failed')
                ])
                ->withInput($request->input());
        }

        return redirect(route('admin.home'));
    }

    public function logOut()
    {
        Auth::logout();

        return redirect(route('marketing::index'));
    }

    public function loggedOut()
    {
        return view('loggedout');
    }
}
