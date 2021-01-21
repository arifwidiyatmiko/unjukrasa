<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class LoginCheck
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
        if (!Auth::check()) {
            return Redirect::to('login');
        }elseif(Auth::user()->role == 'peserta'){
            return Redirect::to('login');
        }
        return $next($request);
    }
}
