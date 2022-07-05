<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Notifications\SystemNotification;
use Notification;

class VerifyEmailController extends Controller
{


    public function __invoke(Request $request): RedirectResponse
    {
        $user = User::find($request->route('id')); //takes user ID from verification link. Even if somebody would hijack the URL, signature will be fail the request
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(config('fortify.home') . '?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        $message = __('Your email has been verified.');

        $details = [
            'subject'      => __('web.greeting') ,
            'greeting'     => __('web.Hi') . ' ' . $user->first_name,
            'body'         => __('web.welcomeToCoursati'),
            'thanks'       => __('web.thanksToUse'),
            'actionText'   =>__('web.visitUs'),
            'actionURL'    => url('/'),
            'course_id'    => null,
            'type'         => 'admin',
        ];

        Notification::send($user, new SystemNotification($details));

        if(auth()->user()->user_type === 3)
        {

                return redirect()->route('coursati.teachQualifications');
        }


        return redirect()->route('coursati.index')->with('status', $message); //if user is already logged in it will redirect to the dashboard page
    }
}
