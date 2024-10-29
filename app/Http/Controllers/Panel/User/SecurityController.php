<?php

namespace App\Http\Controllers\Panel\User;

use App\InsiderUser;
use App\Http\Controllers\Controller;
use App\Http\Validators\Panel\User\PasswordUpdateValidator;
use Hash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class SecurityController extends Controller
{
    private static $PASSWORD_CHANGES_HISTORY_ITEMS_PER_PAGE = 17;
    private static $LOGIN_HISTORY_ITEMS_PER_PAGE = 17;

    public function security()
    {
        return view('panel.user.security');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function passwordUpdate(Request $request)
    {
        $validateRegister = new PasswordUpdateValidator();
        $validator = $validateRegister->validate($request);

        if ($validator->fails()) {
            return redirect(route('user::security'))
                ->withErrors($validator->errors(), 'password')
                ->withInput($request->input());
        }

        $user = auth()->user();
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return redirect(route('user::security'))->with([
            'passwordChanged' => true
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function emailUpdate(Request $request)
    {
        return redirect(route('user::security'))
            ->withErrors(['message' => 'TODO'], 'email')
            ->withInput($request->input());

        // TODO: first we have to get answer what to do with SCM API because cx is defined by email
//        return redirect(route('user::security'));
    }

    /**
     * @return Factory|View
     */
    public function passwordChangesHistory()
    {
        $passwordChangesHistory = InsiderUser::find(auth()->user()->id)
            ->passwordChangesHistory()
            ->orderByDesc('created_at')
            ->paginate(self::$PASSWORD_CHANGES_HISTORY_ITEMS_PER_PAGE);

        return view('panel.user.password_changes_history')->with([
            'passwordChangesHistory' => $passwordChangesHistory
        ]);
    }

    public function loginHistory()
    {
        $loginHistory = InsiderUser::find(auth()->user()->id)
            ->loginHistory()
            ->orderByDesc('created_at')
            ->paginate(self::$LOGIN_HISTORY_ITEMS_PER_PAGE);

        return view('panel.user.login_history')->with([
            'loginHistory' => $loginHistory
        ]);
    }
}
