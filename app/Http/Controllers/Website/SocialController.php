<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

use App\Models\Offer;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\Models\User;
class SocialController extends Controller
{
    public function __construct()
    {
        $offer                      = Offer::where('type' , auth()->guest() ? 'guest' : 'auth')->first();
        view()->share('offer',$offer);

    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->with(["prompt" => "select_account"])->redirect();
    }

    public function Callback($provider){
        try {

            $userSocial             =   Socialite::driver($provider)->stateless()->user();

        $users                      =   User::where(['email' => $userSocial->getEmail()])->first();
        if($users){
            Auth::login($users);
            return redirect('/');
        }else{
            $string                 = $userSocial->getName();

            list($second,$first)    = explode(' ',strrev($string),2);

                $first              = strrev($first);
                $second             = strrev($second);

            $user                   = User::create([
                'first_name'        => isset($first)  ? $first : 'First',
                'last_name'         => isset($second) ? $second : 'Name',
                'email'             => $userSocial->getEmail(),
                'avatar'            => $userSocial->getAvatar(),
                'provider_id'       => $userSocial->getId(),
                'provider'          => $provider,
                'email_verified_at' => \Carbon\Carbon::now(),
            ]);
            Auth::login($user);
            return redirect()->route('coursati.index');
        }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
