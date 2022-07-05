<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Course;
use App\Models\Offer;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \App\Traits\UploadTrait;
use DB;

class ChatController extends Controller
{

    use UploadTrait ;
    public function __construct( )
    {
        $offer                      = Offer::where('type' , auth()->guest() ? 'guest' : 'auth')->first();
        view()->share('offer',$offer);

    }




    public function inbox(Request $request  ){
        $conversations    = chat::whereRoom($request['room'])->get();
        $render           = view('website.components.messages',compact('conversations'))->render();
        return response()->json($render);
    }

    public function sendChatMessage(Request $request  ){

        $course                =   Course::find($request['course_id']);
        $s_id                  =   auth()->id() ;
        if(isset($request['room']))
        {
            $room              =   Room::find($request['room']);
        }else{
            $room              =   Room::where('r_id', $s_id)->where('course_id',$course->id)->first();
        }


        DB::table('notifications')
            ->where('data->type','chat')
            ->where('data->room_id',$room->id)
            ->delete();

        if($request['message'])
        {
            $chat              =    $room->chat()->create([
                's_id'         =>   $s_id,
                'message'      =>   $request['message'],
                'seen'         =>   0 ,
                'type'         =>   'text' ,
            ]);

            $chat->chatRoom->update(['updated_at' => Carbon::now()]);


            sendNotification([
                'subject'           => __('web.newMessage') ,
                'greeting'          => __('web.Hi') . ' ' . $room->receiver->first_name ,
                'body'              => __('web.sender') . auth()->user()->first_name . ' ' . __('web.message') . ' '. $request['message'],
                'course_id'         => $request['course_id'],
                'room_id'           => $room->id,
                'type'              => 'chat',
            ],auth()->id() == $room->receiver->id ?$room->sender : $room->receiver );

        }

        if($request['file'])
        {
            $file     = $request->file('file');
            $mimeType = $file->getClientmimeType();
            if (strpos($mimeType, 'image') !== false) {
                $type = 'image';
            }elseif (strpos($mimeType, 'video') !== false)
            {
                $type = 'video';
            }else{
                $type = 'other';
            }

            $chat              =    $room->chat()->create([
                's_id'         =>   $s_id,
                'message'      =>   $this->uploadFile($request['file']   , 'chat'),
                'seen'         =>   0 ,
                'type'         =>   $type ,
            ]);
            $chat->chatRoom->update(['updated_at' => Carbon::now()]);

            sendNotification([
                'subject'           => __('web.newMessage') ,
                'greeting'          => __('web.Hi') . ' ' . $room->receiver->first_name ,
                'body'              => __('web.sender') . auth()->user()->first_name . ' ' . __('web.send_file')  ,
                'course_id'         => $request['course_id'],
                'room_id'           => $room->id,
                'type'              => 'chat',
            ],auth()->id() == $room->receiver->id ?$room->sender : $room->receiver );

        }



       $render            = view('website.components.sender-msg',compact('chat'))->render();

      return response()->json($render);
    }


}
