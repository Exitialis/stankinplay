<?php

namespace App\Http\Middleware;

use Closure;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ( ! \Auth::guard($guard)->guest()) {
            notificate('Вы уже авторизованы', 'error');
            return redirect()->back();
        }

        return $next($request);
    }
}
