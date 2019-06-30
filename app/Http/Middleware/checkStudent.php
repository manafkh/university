<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Flash;

class checkStudent
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
        if (Auth::user()->role_id != 3){

            Flash::error('Sorry , you have no Permission to view this . ');
            return redirect('\home');
        }
        return $next($request);
    }
}
