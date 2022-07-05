<?php

namespace App\Jobs;

use App\Notifications\SystemNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;

class EmailAll implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users, $message;

    public function __construct($users, $message)
    {
        $this->users         = $users;
        $this->message       = $message;
        $this->handle();
    }


    public function handle(): void
    {
        foreach ($this->users as $user) {
            $details         = [
                'subject'    => __('web.Hi'),
                'greeting'   => __('web.Hi') . ' ' . $user->first_name . ' ' . $user->last_name,
                'body'       => $this->message,
                'thanks'     => __('web.thanksToUse'),
                'actionText' => __('web.visitUs'),
                'actionURL'  => url('/'),
                'course_id'  => null,
                'type'       => 'admin',
            ];
           dd( Notification     ::send($user, new SystemNotification($details)));

        }

    }
}
