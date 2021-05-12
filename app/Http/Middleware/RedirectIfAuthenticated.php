<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        $destination = [
            1 =>  'admin',
            0 => RouteServiceProvider::HOME,

        ];
        if (Auth::guard($guard)->check()) {
            return redirect()->route($destination[Auth::user()->role]);
        }
        return $next($request);
    }
}
