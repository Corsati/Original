<?php

namespace App\Http\Middleware;

 use Illuminate\Auth\Middleware\Authenticate as Middleware;
 use Closure;

class WebAuth extends Middleware
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

        if(!auth()->guest())
        {
            return $next($request);
        }
        return redirect()->route('coursati.indexGuest');
    }
}
