<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Instructor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        if(!Auth::guest() && (Auth::user()->user_type==3)){
            return $next($request);
        }

       return redirect(route('coursati.upgradeToInstructor'));

    }
}
