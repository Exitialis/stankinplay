<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Role
{
    protected $auth;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @param  $roles
     * @param string $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $roles, $guard = 'web')
    {
        $this->auth = \Auth::guard($guard);

        if ($this->auth->guest() || !$this->auth->user()->hasRole(explode('|', $roles))) {
            abort(403);
        }

        return $next($request);
    }
}
