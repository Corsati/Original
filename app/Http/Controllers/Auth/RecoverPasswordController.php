<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class RecoverPasswordController extends Controller
{


    /**
     * forget password .
     * @param  $request
     * @return route
     */

    public function forgetPassword(Request $request){
        $request->validate(['email'       => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? view('user::auth.reset-link-sent')
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * reset password .
     * @param  $request
     * @return route
     */
    public function resetPassword(Request $request){

        $request->validate([
            'token'            => 'required',
            'broker'           => 'required|in:users,admins',
            'email'            => 'required|email',
            'password'         => 'required|min:8|confirmed',
        ]);
        $status = Password::broker($request['broker'])->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => $password
                ])->save();

                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route( $request['broker'] === 'users' ? 'user.login' : 'admin.login' )->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
