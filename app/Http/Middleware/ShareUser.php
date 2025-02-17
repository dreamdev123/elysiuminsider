<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use View;

class ShareUser
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
        View::share('user', auth()->user());

        return $next($request);
    }
}
