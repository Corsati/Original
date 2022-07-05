<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Course\Create;
use App\Models\Course;
use App\Models\Offer;
use App\Models\Room;
use App\Models\UserCourse;
use App\Notifications\SystemNotification;
use App\Repositories\Interfaces\ICourse;
use App\Repositories\Interfaces\ICart;
use Illuminate\Http\Request;
use Notification;

class CartController extends Controller
{

    protected                 $courseRepo;
    protected                 $cartRepo;

    public function __construct( ICourse $course , ICart $cartRepo )
    {
        $this->courseRepo    = $course;
        $this->cartRepo      = $cartRepo;
        $offer                      = Offer::where('type' , auth()->guest() ? 'guest' : 'auth')->first();
        view()->share('offer',$offer);

    }


    public function addToCart(Request $request){
        $cart                = $this->cartRepo->addCart($request['id']);
        return response()->json(['msg' => $cart ? __('web.addedCarts') :  __('web.removedCart') ,'isFav' => $cart]);
    }

    public function buyNow($id){
        $this->cartRepo->addCart($id);
        return redirect()->route('coursati.cart');
    }

    public function cart(){
        return view('website.auth.cart');
    }

    public function deleteItem(Request $request){
        $this->cartRepo->softDelete($this->cartRepo->find($request['id']));
        return response()->json(['msg' =>  __('web.removedCart') ,'total' => auth()->user()->cart()->sum('price'),'count' =>  count($this->cartRepo->get())]);
    }

    public function completePurchase(Request $request){
        foreach (auth()->user()->cart as $cart)
        {
            $ifExists         = UserCourse::where('user_id' , auth()->id())->where('course_id'  , $cart->course_id)->first();
            if($ifExists)
            {
                //return         redirect()->back();
            }

            UserCourse::create(
                    [
                'user_id'     => auth()->id(),
                'course_id'   => $cart->course_id
                    ]
                );

            sendNotification([
                'subject'     => __('web.purchase'),
                'greeting'    => __('web.Hi') . ' ' . auth()->user()->first_name,
                'body'        => __('web.purchase'),
                'course_id'   => $cart->course_id,
                'type'        => 'course',
            ],auth()->user());

            $course            = Course::find($cart->course_id);

            sendNotification([
                'subject'      => __('web.do-purchase') ,
                'greeting'     => __('web.Hi') . ' ' . auth()->user()->first_name,
                'body'         => __('web.do-purchase'),
                'course_id'    => $cart->course_id,
                'type'         => 'course',
            ],$course->user()->first());


            $room               = Room::create([
                    's_id'      =>$course->user_id,
                    'r_id'      =>auth()->id(),
                    'course_id' =>$cart->course_id
                ]);

            $room->chat()->create([
                's_id'         =>   $course->user_id,
                'message'      =>   __('web.thanU'),
                'seen'         =>   0 ,
                'type'         =>   'text' ,
            ]);

            $cart->delete();
        }


        return redirect()->route('coursati.myCourses');
    }
}
