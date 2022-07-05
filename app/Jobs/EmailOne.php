<?php

namespace App\Jobs;

use App\Mail\SendMail;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Notification;
class EmailOne implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email, $data , $template;

    public function __construct($email, $data , $template = 'send_mail')
    {
        $this->email         = $email;
        $this->data          = $data;
        $this->template      = $template;
        $this->handle();
    }


    public function handle(): void
    {


        $user               = User::where('email', $this->email)->first();
        if($user)
        {
            $details         = [
                'subject'    => __('web.Hi'),
                'greeting'   => __('web.Hi') . ' ' . $user->first_name . ' ' . $user->last_name,
                'body'       => $this->data,
                'thanks'     => __('web.thanksToUse'),
                'actionText' => __('web.visitUs'),
                'actionURL'  => url('/'),
                'course_id'  => null,
                'type'       => 'admin',
            ];
            Notification     ::send($user, new SystemNotification($details));

        }

    }
}
