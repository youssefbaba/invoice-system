<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Queue\RedisQueue;
use Illuminate\Routing\RedirectController;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\RedisHandler;
use App\Providers\RouteServiceProvider;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $destination = [
            0 => RouteServiceProvider::HOME,
        ];
        if (!Auth::check()) {
            return  redirect()->route('login');
        }
        if (Auth::user()->role !== 1) {
            return redirect()->route($destination[0]);
        }
        return $next($request);
    }
}
