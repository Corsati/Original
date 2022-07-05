<?php

namespace App\Repositories\Eloquent;

use App\Models\CategoryUser;
use App\Models\Course;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\User;
use App\Repositories\Interfaces\IQualification;
use App\Repositories\Interfaces\ITeachingCategory;
use App\Repositories\Interfaces\IUser;
use App\Jobs\EmailAll;
use App\Jobs\EmailOne;
use App\Jobs\SmsAll;
use Notification;
class UserRepository extends AbstractModelRepository implements IUser
{


    protected $qualificationRepo;
    protected $teachingCategoryRepo;

    public function __construct(User $model , IQualification $qualificationRepo , ITeachingCategory $teachingCategoryRepo)
    {
        parent::__construct($model);

        $this->qualificationRepo       = $qualificationRepo;
        $this->teachingCategoryRepo    = $teachingCategoryRepo;
    }

    public function users($type)
    {
        return $this->model->where('id','!=',1)->where('user_type',$type)->with('categories')->latest()->get();
    }

    public function popular(){
     return $this->model->whereHas('courses',function ($q){
            $q->whereHas('userCourses',function ($r){
           });
     })->take(10)->get();
    }

  public function popularUsers($id = null){
     return $this->model->where('user_type',User::INSTRUCTOR)->whereHas('userCourses',function ($q) use($id){
         $ids    = Course::whereCategoryId($id)->pluck('id');
         $q->whereIn('course_id',$ids);
     })->take(10)->get();
    }
    public function popularStudents($id = null){
     return $this->model->where('user_type',User::STUDENT)->whereHas('userCourses',function ($q) use($id){

     })->take(10)->get();
    }

    public function instructors()
    {
        return $this->model->whereNull('role_id')->where('user_type',User::INSTRUCTOR)->with('categories')->latest()->get();
    }


    public function upgradeToInstructor($attributes)
    {
        // TODO: Implement upgradeToInstructor() method.
        $data                           = filter_request_keys($attributes);
        $data['user_type']              = User::INSTRUCTOR;
        $user                           = $this->findOrFail($attributes['id']);
        $this                           ->update($user,$data);
        $user->instructor()->updateOrCreate(['user_id' => $attributes['id']],$data);

            if(isset($attributes['academy']))
            {
                foreach ($attributes['academy'] as $key => $value){
                    if (!in_array(null, $value, true)  &&  !in_array('', $value, true)) {
                        $value['user_id']   = $attributes['id'];
                        $this->qualificationRepo->store($value);
                    }
                }
            }


            if(isset($attributes['experience']))
            {
                foreach ($attributes['experience'] as $key => $value){
                    if (!in_array(null, $value, true)  &&  !in_array('', $value, true)) {
                        $value['user_id']    = $attributes['id'];
                        $this->teachingCategoryRepo->store($value);
                    }
                }
            }


        if(isset($attributes['category_id']) && is_array($attributes['category_id']))
        {
            foreach ($attributes['category_id'] as $cat)
                CategoryUser::updateOrCreate(['user_id' => $user->id , 'category_id' => $cat]);
        }
    }

    public function upgradeStepOne($attributes)
    {
        // TODO: Implement upgradeToInstructor() method.
        $data                           = filter_request_keys($attributes);
        $user                           = $this->findOrFail(\auth()->id());
        $this  ->update($user,$data);
        $user->instructor()->updateOrCreate(['user_id' => auth()->id()],$data);

    }


    public function ExtraToInstructor($attributes,$useId)
    {

        if(isset($attributes['academy']))
        {
            foreach ($attributes['academy'] as $key => $value){
                if (!in_array(null, $value, true)  &&  !in_array('', $value, true)) {
                    $value['user_id']      = $useId;
                    $this->qualificationRepo->store($value);
                }
            }
        }


        if(isset($attributes['experience']))
        {
            foreach ($attributes['experience'] as $key => $value){
                if (!in_array(null, $value, true)  &&  !in_array('', $value, true)) {
                    $value['user_id']     = $attributes['id'];
                    $this->teachingCategoryRepo->store($value);
                }
            }
        }

    }


    public function messageOne($data, $type , $template = 'send_mail') : void
    {
         $user   = $this->model->where('id',auth()->id())->first();

        if($type === 'notification') {

         }
         elseif($type === 'email') {
            dispatch(new EmailOne($user->email, $data , $template));
        }
        elseif($type === 'sms') {
            dispatch(new SmsAll($user->phone, $data['message']));
        }

    }

    public function messageAll($data, $type ) : void
    {

        $emails                = $this->model::where('user_type',$data['user_type'])->get();
        if($type               === 'notification') {
            foreach ($emails as $user) {
                sendNotification([
                'subject'       => __('web.Hi'),
                'greeting'      => __('web.Hi') . ' ' .$user->first_name,
                'body'          => $data['message'],
                'course_id'     => null,
                'type'          => 'admin',
            ],$user);
           }
        } elseif($type           === 'email') {
            foreach ($emails as $user) {
                $details         = [
                    'subject'    => __('web.Hi'),
                    'greeting'   => __('web.Hi') . ' ' . $user->first_name . ' ' . $user->last_name,
                    'body'       => $data['message'],
                    'thanks'     => __('web.thanksToUse'),
                    'actionText' => __('web.visitUs'),
                    'actionURL'  => url('/'),
                    'course_id'  => null,
                    'type'       => 'admin',
                ];
               Notification     ::send($user, new SystemNotification($details));
            }
        } elseif($type           === 'sms') {
            $phones              = $this->model->select('phone')->where('user_type',$data['user_type'])->pluck('phone')->toArray();
            dispatch(new SmsAll($phones, $data['message']));
        }
    }

}
