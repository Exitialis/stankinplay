<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ( ! \Auth::guard($guard)->check()) {
            notificate('Необходима авторизация', 'error');
            return redirect()->route('login.get');
        }

        return $next($request);
    }
}
