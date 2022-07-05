<?php

namespace App\Jobs;

use App\Notifications\Api\OrderNotify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Order;
use App\Models\SiteSetting;
class NotifiySpecialOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userType ,  $data ;

    public function __construct($userType , $data )
    {
        $this->data              = $data;
        $this->userType          = $userType;
        $this->handle();
    }


    public function handle(): void
    {
        $allowedCount            = (int) SiteSetting::where('key','delegate_allowed_order_count')->first()->value;
        $users                   = User::with('devices')->where('user_type' ,$this->userType)->get();
        foreach ($users as $user)
        {
            $runningOrders       = Order::where('delegate_id', $user->id)
                                    ->whereIn('status',['DELEGATEACCEPT','DELEGATEARRIVED','DELIVEREDTODELEGATE','ONWAY','ARRIVED','DELIVER'])
                                    ->count();
            if( $allowedCount    < $runningOrders )
            {
                $tokens          = $user->devices->pluck('device_id')->toArray();
                $user->notify(new OrderNotify($tokens, $this->data));
            }
        }
    }
}

