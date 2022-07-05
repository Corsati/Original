<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Course\Create;
use App\Http\Requests\Website\Course\CreateComment;
use App\Http\Requests\Website\Course\CreateStepTwo;
use App\Http\Requests\Website\Course\CreateStepThree;
use App\Http\Requests\Website\Course\UploadTask;
use App\Models\Chat;
use App\Models\Comment;
use App\Models\Course;
use App\Models\CourseCertificate;
use App\Models\Offer;
use App\Models\Room;
use App\Repositories\Interfaces\IAcademic;
use App\Repositories\Interfaces\ICategory;
use App\Repositories\Interfaces\ICourse;
use App\Repositories\Interfaces\ICourseBenefit;
use App\Repositories\Interfaces\IDuration;
use App\Repositories\Interfaces\IPriceTire;
use App\Repositories\Interfaces\IUser;
use Illuminate\Http\Request;
use Notification;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    protected  $courseRepo;
    protected  $categoeyRepo;
    protected  $benefitRepo;
    protected  $userRepo;
    protected  $priceTireRepo;
    protected  $durationRepo;
    protected  $academicRepo;

    public function __construct( ICourse $course , IUser $user , ICategory $category , ICourseBenefit $benefit, IPriceTire $priceTire, IDuration $duration , IAcademic $academic)
    {
        $this->courseRepo   = $course;
        $this->categoeyRepo = $category;
        $this->benefitRepo  = $benefit;
        $this->userRepo     = $user;
        $this->priceTireRepo= $priceTire;
        $this->academicRepo = $academic;
        $this->durationRepo = $duration;
        $offer              = Offer::where('type' , auth()->guest() ? 'guest' : 'auth')->first();
        view()->share('offer',$offer);

    }

   public function create($id, $name = '' ,$courseId = null)
   {
       $course = null;
       $courseCategories= [];
       $this->categoeyRepo->findOrFail($id);

       if ($courseId)
       {
           $course          = $this->courseRepo->findOrFail($courseId);
           $categories      = $course->categories()->pluck('category_id')->toArray();
           foreach ($categories as $category)
           {
               $courseCategories[] = $category;
           }
           $courseCategories= $courseCategories;
       }

       $prices              = $this->priceTireRepo->get();
       $durations           = $this->durationRepo->get();
       $academics           = $this->academicRepo->get();
       return view('website.site.courses.create-course',compact('id','courseCategories','course','prices' , 'durations' , 'academics'));
   }

   public function createStepTwo($id)
   {
       $course              = $this->courseRepo->findOrFail($id);
       $categoryId          = $course->category_id;
       return view('website.site.courses.createStepTwo',compact('id','categoryId','course'));
   }

   public function createStepThree($id)
   {
       $course              = $this->courseRepo->findOrFail($id);
       $categoryId          = $course->category_id;
       return view('website.site.courses.createStepThree',compact('id','categoryId','course'));
   }

   public function storeCourse(Create $request)
   {
       $course              = $this->courseRepo-> add($request->validated()+['user_id' => auth()->id()]);
       $page                =  url('create-step-two/'.$course->id);
       if(is_null($course->image) || is_null($course->promotional_video) || is_null($course->description) || is_null($course->price) || is_null($course->level) || is_null($course->total_hours) || count($course->requirements) == 0)
       {
       $page                =  url('create-course/'.$course->category_id.'/edit/'.$course->id.'');
       }
       return response()->json(['url' => $request['type'] != 'later'  ?  $page :route('coursati.teacherDashboard'), 'id' => $course->id   ]);
    }

    public function storeCourseTwo(CreateStepTwo $request)
   {
       $this->courseRepo-> CreateStepTwo($request->validated()+['user_id' => auth()->id()]);
       return response()->json(['url' => $request['type'] != 'later'  ?  url('create-step-three/'. $request['course_id']) :route('coursati.teacherDashboard'), 'id' => $request['course_id']   ]);
    }

    public function storeStepThree(CreateStepThree $request)
   {
       $this->courseRepo-> storeStepThree($request->validated()+['user_id' => auth()->id()]);
       return response()->json(['url' => route('coursati.teacherDashboard'), 'id' => $request['course_id']   ]);
   }

   public function courseDetails($id,$title = '' , $roomId = null)
   {

       $userCourse           = null;
       $course               = $this->courseRepo->findOrFail($id);
       seo()->title(\Illuminate\Support\Str::limit(  $course->getTranslation('title',courseLng($course)) , 59 ,  '...'));
       seo()->description($course->description);
       seo()->image($course->image);

       $conversations        = [];
       if(!auth()->guest())
       {


           $room             = Room::where('r_id',\auth()->id() )->where('course_id',$course->id)->first();
           if($room)
           {
               $conversations    = chat::whereRoom($room->id)->get();
           }

           $userCourse       = auth()->user()->userCourses()->whereCourseId($id)->first();
       }

       return view($userCourse? 'website.site.courses.myCourse' : 'website.site.courses.course',compact('course','conversations'));
   }

   public function courses(){
        return view('website.site.courses.courses');
   }

   public function favourite(Request $request){
       $favourite             = $this->courseRepo->addFavourite($request['id']);
       return response()->json(['msg' => $favourite ? __('web.addedFavourite') :  __('web.removedFavourite') ,'isFav' => $favourite]);
   }

   public function addToCart(Request $request){
       $cart                   = $this->courseRepo->addCart($request['id']);
       return response()->json(['msg' => $cart ? __('web.addedCarts') :  __('web.removedCart') ,'isFav' => $cart]);
   }

   public function myCourses(){
        return view('website.site.courses.myCourses');
   }

   public function favourites(){
       $users                    = $this->userRepo           ->popularUsers(null);
       return view('website.auth.favourites' ,compact('users'));
   }

    public function deleteCourse($id){
        $course                 = $this->courseRepo->findOrFail($id);
        $this->courseRepo->delete($course);
        return redirect()->back();
    }

    public function comment(CreateComment $request){
        $user                   = Auth::id();
        $data                   = array_filter($request->all());
        $comment                = Comment::updateOrCreate(['user_id' => $user], $data);
        $course                 = Course::find($request['course_id']);
        sendNotification([
            'subject'           => __('web.newComment') ,
            'greeting'          => __('web.Hi') . ' ' . $course->user->first_name ,
            'body'              => __('web.commented') . auth()->user()->first_name . ' ' . __('web.on_your'),
            'course_id'         => $request['course_id'],
            'type'              => 'course',
        ],$course->user);

        return response()->json(['url' => route('coursati.myCourse',$comment->course_id)]);
    }

    public function completeCourse(Request $request){
        $this->courseRepo->complete($request->all());
    }

    public function filterByRate(Request $request){
        $courses                = $this->courseRepo->coursesByRate($request->all());
        $html                   = view('website.components.courses-by-rate', compact('courses'))->render();
        return response()->json($html);
    }

    public function bestCourses(Request  $request){
        sleep(2);
        $courses                = $this->courseRepo->bestCourses($request['id']);
        $html                   = view('website.components.popular-courses', compact('courses'))->render();
        return response()->json($html);
    }

    public function deleteCertificate($id){
        CourseCertificate::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function taskSubmit(UploadTask $request){

    }

}
