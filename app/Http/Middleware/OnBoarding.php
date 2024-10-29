<?php

namespace App\Http\Middleware;

use App\InsiderUserOnBoarding;
use Closure;
use Illuminate\Http\Request;

class OnBoarding
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        $allowedRoutes = [
            'auth::logout',
            'user::security_login_history',
            'user::security_password_changes_history',
            'verify_email_token'
        ];

        if (!in_array($request->route()->getName(), $allowedRoutes, true)) {
            $onBoaring = $user->onboarding;

            foreach (InsiderUserOnBoarding::$requiredSatges as $stage) {
                // if cx didnt fill onboarding forms
                if (!$onBoaring->$stage && !$request->isMethod('post') && !in_array($request->route()->getName(), InsiderUserOnBoarding::$requiredSatges, true)) {

                    return redirect(route($stage));
                }
            }
        }

        return $next($request);
    }
}
