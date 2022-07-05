<?php

namespace App\Http\Middleware;

use App;
use App\Models\Offer;
use Closure;
use Carbon\Carbon;
class Localization
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
        if (session()->has('language')) {
            /** Set Lang **/
            session()->get('language') == 'en' ? App::setLocale('en')    : App::setLocale('ar');
            /** Set Carbon Language **/
            session()->get('language') == 'en' ? Carbon::setLocale('en') : Carbon::setLocale('ar');
            return $next($request);
        }


        return $next($request);
    }
}
