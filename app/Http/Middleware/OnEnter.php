<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class OnEnter
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
        if (Auth::user() &&  Auth::user()->status >= 4)
        {
            \Config::set('app.debug', true);
            \Config::set('app.env', 'local');
            return $next($request);
        }
        else
        {
            \Config::set('app.debug', false);
            return $next($request);
        }
    }
}
