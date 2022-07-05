<?php

namespace App\Repositories\Eloquent;

use App\Models\Carts;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Favourite;
use App\Repositories\Interfaces\ICourse;
use App\Repositories\Interfaces\ICourseBenefit;
use App\Repositories\Interfaces\ICourseCertificate;
use App\Repositories\Interfaces\ICourseLecture;
use App\Repositories\Interfaces\ICourseRequirement;
use App\Repositories\Interfaces\ICourseLectureTest;
use App\Repositories\Interfaces\ICourseContent;
use App\Repositories\Interfaces\ICourseLectureFile;
use App\Repositories\Interfaces\IFavourite;
use App\Repositories\Interfaces\IFinishedLecture;
use App\Repositories\Interfaces\IPriceTire;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;


class CourseRepository extends AbstractModelRepository implements ICourse
{

    CONST                              TAKE            = 10;
    CONST                              PAGES           = 5;
    protected                          $courseRequirement;
    protected                          $courseLectureTest;
    protected                          $courseLecture;
    protected                          $courseBenefit;
    protected                          $courseContent;
    protected                          $courseCertificate;
    protected                          $courseLectureFile;
    protected                          $favouriteRepo;
    protected                          $finishedRepo;
    protected                          $priceTireRepo;

    public function __construct(
          Course                       $model  ,
          ICourseRequirement           $courseRequirement,
          ICourseLecture               $courseLecture,
          ICourseLectureTest           $courseLectureTest,
          ICourseLectureFile           $courseLectureFile,
          ICourseContent               $courseContent,
          ICourseCertificate           $courseCertificate,
          IFavourite                   $favouriteRepo,
          IFinishedLecture             $finishedRepo,
          IPriceTire                   $priceTireRepo,
          ICourseBenefit               $courseBenefit)
    {
        parent::__construct($model);
        $this->courseRequirement       = $courseRequirement;
        $this->courseLecture           = $courseLecture;
        $this->courseLectureTest       = $courseLectureTest;
        $this->courseContent           = $courseContent;
        $this->courseCertificate       = $courseCertificate;
        $this->courseBenefit           = $courseBenefit;
        $this->courseLectureFile       = $courseLectureFile;
        $this->favouriteRepo           = $favouriteRepo;
        $this->favouriteRepo           = $favouriteRepo;
        $this->finishedRepo            = $finishedRepo;
        $this->priceTireRepo           = $priceTireRepo;
    }



    public function popular($id)
    {
        //return $this->model->where('status',Course::ACTIVE)->paginate(20);

        $courses                      = $this->model->query();
        if($id)
         $courses                     = $courses->whereCategoryId($id);

        $courses                      = $courses->whereHas('userCourses', function ($q) {
        })->take($this::TAKE)->where('status', Course::ACTIVE)->inRandomOrder()->get()->sortByDesc(function ($views) {
            return $views->userCourses->count();
        });

        if (count($courses) == 0){
            $courses                  =  $this->model->query();
            if($id)
            {
                $courses->whereHas('categories',function ($q) use ($id){
                    $q->where('category_id',$id);
                });
            }
            $courses                  =  $courses->take($this::TAKE)->inRandomOrder()->where('status',Course::ACTIVE)->latest()->get();
           return $courses;
        }

        else
            return $courses;
    }


    public function randomCourse($id){
        //return $this->model->where('status',Course::ACTIVE)->paginate(20);

        return $this->model->inRandomOrder()->where('status',Course::ACTIVE)->whereHas('categories',function ($q) use ($id){
            $q->where('category_id',$id);
        })->first();
    }

    public function bestCourses($id){
        //return $this->model->where('status',Course::ACTIVE)->paginate(20);

        return  $this->model::whereHas('comments')->where('status',Course::ACTIVE)->whereHas('categories',function ($q) use ($id){
            $q->where('category_id',$id);
        })->paginate($this::PAGES);
    }


    public function courses(){
        //return $this->model->where('status',Course::ACTIVE)->paginate(20);

        return $this->model->where('status',Course::ACTIVE)->paginate($this::PAGES);
    }

    public function categoryCourses($id,$take = null){

        $rate                          =  request('rate');


        $courses =  $this->model->query();
        if(request('rate'))
        {
            $courses->whereHas('comments',function ($q) use ($rate){
                $q->where('rate',$rate);
            });

        }

        $courses->whereHas('categories',function ($q) use ($id){
            $q->where('category_id',$id);
        });


        if(request('total_hours')) {
            $courses->where('total_hours', request('total_hours'));
        }

      return  $courses->where('status',Course::ACTIVE)->latest()->paginate(4);

    }

    public function setValue($key,$value){

    }
    public function add($attributes          = [])
    {

       return  DB::transaction(function () use ($attributes){

           $currentLang =  App::getLocale();
           if(!isset($attributes['language']))
               $attributes['language']  = App::getLocale();


           if($attributes['course_id'])
           {
               $course                  = $this->model->find($attributes['course_id']);
               $attributes['language']  = courseLng($course);
               app()->setLocale(courseLng($course));

               if(count($attributes['requirements']) > 0)
               {
                   $course->requirements()->delete();
               }

               if($course->steps        != 'three')
                   $attributes['step']  = 'one';

           }


           $attributes['promotional_video_id']
               = getVideoId($attributes['promotional_video']);
           if (!empty($attributes['course_id']))
           {

               $course->update($attributes);
               $course->setTranslation('title'      , $course->language , $attributes['title']);
               $course->setTranslation('description', $course->language , $attributes['description']);

           } else{
               $attributes['title']         = $attributes['language'] == 'ar' ? ['en' => "", 'ar' => $attributes['title']] : ['ar' => "", 'en' => $attributes['title']];
               $attributes['description']   = $attributes['language'] == 'ar' ? ['en' => "", 'ar' => $attributes['description']] : ['ar' => "", 'en' => $attributes['description']];
               $course                      = $this->model->create($attributes) ;
               CourseCategory::create([
                   'category_id'            => $attributes['category_id'],
                   'course_id'              => $course->id
               ]);
           }


           foreach ($attributes['requirements'] as   $value) {
               if($value)
               {

                   $this->courseRequirement->store([
                       'name'             => $attributes['language'] == 'ar' ? ['en' => "", 'ar' => $value] : ['ar' => "", 'en' => $value],
                       'course_id'        => $course->id
                   ]);
               }
           }

           foreach ($attributes['categories'] as   $value) {
                 CourseCategory::whereCategoryId($value)->delete();
                 CourseCategory::create([
                       'category_id'      => $value,
                       'course_id'        => $course->id
                   ]);
           }

           if(count($course->lectures) == 0)
           {
               $course->update(['steps' => 'one']);
           }

           app()->setLocale($currentLang);
           return $course;
        });

    }


    public function CreateStepTwo($attributes = [])
    {

        return  DB::transaction(function () use ($attributes){

            $course          = $this->model->find($attributes['course_id']);
            $currentLang     =  App::getLocale();
            app()->setLocale(courseLng($course));

         if(count($course->lectures)>0)
         {
            foreach ($course->lectures as $l)
            {
                $l->delete();
            }
         }

        foreach ($attributes['course_lectures'] as $lecture)
        {

            if($lecture['title'])
            {
                $result = $this->courseLecture->store([
                    'name'                    => $course->language  == 'ar' ? ['en' => " ", 'ar' => $lecture['title']] : ['ar' => " ", 'en' => $lecture['title']],
                    'course_id'               => $course->id
                ]);

                foreach ($lecture['course_lectures_files'] as $file)
                {
                    $this->courseLectureFile->store([
                        'name'                 => $course->language  == 'ar' ? ['en' => " ", 'ar' => $file['name']] : ['ar' => " ", 'en' => $file['name']],
                        'file'                 => $file['video'],
                        'content_file_type'    => 'video',
                        'video_id'             => getVideoId($file['video']),
                        'video_time'           => getVideoTime(getVideoId($file['video'])),
                        'course_lecture_id'    => $result->id
                    ]);
                }
            }
        }

        if(count($course->lectures) > 0)
        {
            if($course->steps != 'three')
                $course->update(['steps' => 'two']);
        }else{
            $course->update(['steps' => 'one']);
        }


        app()->setLocale($currentLang);

        return $course;

        });
    }

    public function complete($attributes){
        $lecture   = $this->courseLectureFile->findByVideoId($attributes['video_id']);
        $video
             = $this->finishedRepo->checkIfExists($lecture->id);
        if($video)
            $video->delete();


        $this->finishedRepo->store([
            'course_lecture_file_id'   => $lecture->id,
            'user_id'                  => auth()->id(),
            'completed'                => $attributes['completed']
        ]);
    }

    public function storeStepThree($attributes = [])
    {
        $course                        = $this->model->find($attributes['course_id']);

        if(count($course->benefits) > 0)
            $course->benefits()->delete();


        if(count($attributes['benefits']) > 0)
        {
            foreach ($attributes['benefits'] as    $value) {
                if($value)
                {
                    $this->courseBenefit->store([
                        'name'          => $course->language  == 'ar' ? ['en' => " ", 'ar' => $value] : ['ar' => " ", 'en' => $value],
                        'course_id'     => $course->id
                    ]);
                }
            }
        }

        if(count($course->contents) > 0)
            $course->contents()->delete();

        if(count($attributes['contents']) >  0)
        {
            foreach ($attributes['contents'] as   $value) {
                if($value)
                {
                    $this->courseContent->store([
                        'name'                          => $course->language  == 'ar' ? ['en' => " ", 'ar' => $value] : ['ar' => " ", 'en' => $value],
                        'course_id'                     => $course->id
                    ]);
                }
            }
        }



            foreach ($attributes['certificates'] as   $value) {
                if($value['details']){
                    if(isset($value['files']))
                    {
                        $this->courseCertificate->store([
                            'title'                     => ' ',
                            'details'                   => $course->language  == 'ar' ? ['en' => " ", 'ar' => $value['details']] : ['ar' => " ", 'en' => $value['details']],
                            'course_id'                 => $course->id,
                            'file'                      => $value['files'],
                            'file_type'                 => $value['files']->getClientmimeType()
                        ]);
                    }
                }
            }



        $course->update(['steps' => $attributes['steps']]);

    }

    public function store($attributes = [])
    {

        if (isset($attributes['name_ar']) && isset($attributes['name_en']))
            $attributes['name'] = $this->setName($attributes['name_ar'], $attributes['name_en']);


        if (isset($attributes['title_ar']) && isset($attributes['title_en']))
            $attributes['title'] = $this->setName($attributes['title_ar'], $attributes['title_en']);


        if (isset($attributes['description_ar']) && isset($attributes['description_en']))
            $attributes['description'] = $this->setName($attributes['description_ar'], $attributes['description_en']);



        if (!empty($attributes))
            $course = $this->model->create($attributes);


        foreach ($attributes['requirements'] as $key => $value) {
            if (!in_array(null, $value, true) && !in_array('', $value, true)) {
                $this->courseRequirement->store([
                    'name'             => $this->setName($value['name_ar'], $value['name_en']),
                    'course_id'        => $course->id
                ]);
            }
        }


        foreach ($attributes['benefits'] as $key => $value) {
            if (!in_array(null, $value, true) && !in_array('', $value, true)) {
                $this->courseBenefit->store([
                    'name' => $this->setName($value['name_ar'], $value['name_en']),
                    'course_id' => $course->id
                ]);
            }
        }

        foreach ($attributes['contents'] as $key => $value) {
            if (!in_array(null, $value, true) && !in_array('', $value, true)) {
                $this->courseContent->store([
                    'name' => $this->setName($value['name_ar'], $value['name_en']),
                    'course_id' => $course->id
                ]);
            }
        }

        foreach ($attributes['certificates'] as $key => $value) {
            if (!in_array(null, $value, true) && !in_array('', $value, true)) {
                $this->courseCertificate->store([
                    'title' => $this->setTitle($value['title_ar'], $value['title_en']),
                    'details' => $this->setDetails($value['details_ar'], $value['details_en']),
                    'course_id' => $course->id,
                    'file' => $value['file'],
                    'file_type' => $value['file']->getClientmimeType(),
                ]);
            }
        }

        foreach ($attributes['course_lectures'] as $key => $value) {
            if (!in_array(null, $value, true) && !in_array('', $value, true)) {
                $result = $this->courseLecture->store([
                    'name' => $this->setName($value['name_ar'], $value['name_en']),
                    'course_id' => $course->id
                ]);

                if ($value['tests']['name_ar']) {
                    $this->courseLectureTest->store([
                        'name' => $this->setName($value['tests']['name_ar'], $value['tests']['name_en']),
                        'file' => $value['tests']['file'],
                        'content_file_type' => $value['tests']['file']->getClientmimeType(),
                        'course_lecture_id' => $result->id
                    ]);
                }
            }
        }

    }

    public function getCourses($type, $ids = [] , $take = 100)
    {
        //return $this->model->where('status',Course::ACTIVE)->paginate(20);

        $courses  = $this->model->query();

        if($type)
            $courses->where('status', $type);

        if(count($ids) >0)
            $courses->whereIn('id',$ids);

        $courses->take($take);

        return $courses->get();
    }

    public function getCoursesByCategory($id)
    {
        //return $this->model->where('status',Course::ACTIVE)->paginate(20);

        if(is_array($id))
        {
            return $this->model->where('steps','three')->where('status',$this->model::ACTIVE)
                ->whereHas('categories',function ($q) use ($id){
                    $q->whereIn('category_id',$id);
                })->paginate(app()->paginate);
        }else{
            return $this->model->where('steps','three')->where('status',$this->model::ACTIVE)->whereHas('categories',function ($q) use ($id){
                $q->where('category_id',$id);
            })->paginate(app()->paginate);
        }
    }

    public function getCoursesByCategoryCount($id)
    {
        //return $this->model->where('status',Course::ACTIVE)->paginate(20);

        if(is_array($id))
        {
            return $this->model->where('steps','three')->where('status',$this->model::ACTIVE)
                ->whereHas('categories',function ($q) use ($id){
                    $q->whereIn('category_id',$id);
                })->paginate(app()->paginate);
        }else{
            return $this->model->where('steps','three')->where('status',$this->model::ACTIVE)->whereHas('categories',function ($q) use ($id){
                $q->where('category_id',$id);
            })->count();
        }
    }

    public function recommended()
    {
        //return $this->model->where('status',Course::ACTIVE)->paginate(20);

        return $this->model->where('steps','three')->where('status',$this->model::ACTIVE)->get();
    }

    public function addFavourite($id){
      $isFavourite                     = Favourite::where('user_id', auth()->id())->where('course_id',$id)->first();
      if(!$isFavourite)
      {
          Favourite::create(['user_id' => auth()->id() , 'course_id' => $id]);
          return true;
      }
      else
          $isFavourite->delete();


      return false;
    }


    public function coursesByRate($attributes)
    {
       // return $this->model->where('status',Course::ACTIVE)->paginate(20);

        $id                            =  $attributes['id'];
        $rate                          =  $attributes['rate'];
        if($rate != 0)
        {
            return  $this->model::whereHas('comments',function ($q) use ($rate){
                $q->where('rate',$rate);
            })->where('status',Course::ACTIVE)    ->whereHas('categories',function ($q) use ($id){
                $q->where('category_id',$id);
            })->get();
        }
        return  $this->model->where('status',Course::ACTIVE)    ->whereHas('categories',function ($q) use ($id){
            $q->where('category_id',$id);
        })->get();

    }

    public function instructorCourses($id){
        //return $this->model->where('status',Course::ACTIVE)->paginate(20);

        return $this->model->where('user_id',$id)->where('steps','three')->where('status',$this->model::ACTIVE)->get();
    }

    public function search($attributes){
        $query           = $this->model->query();
        if(isset($attributes['name_search']))
        {
            $name        = $attributes['name_search'];
            $query->where('title','like','%'.$attributes['name_search'].'%');
        }

        if(isset($attributes['topics']))
        {
             $topics     = $attributes['topics'];
             $query ->whereHas('categories',function ($q) use ($topics){
                $q->whereIn('category_id',$topics);
           });
        }

        if(isset($attributes['levels']))
        {

            if(is_array($attributes['levels']))
            {
                $query->whereIn('level',$attributes['levels']);
            }else{
                $query->where('level',$attributes['levels']);
            }
        }

        if(isset($attributes['prices']))
        {
            if(count($attributes['prices']) == 2){

            }else{
                if($attributes['prices'][0] == 'paid')
                {
                    $query->where('price','>',0);
                }else if($attributes['prices'][0] == 'free'){
                    $query->where('price',null);
                }else{}
            }
        }

        if(isset($attributes['ratings']))
        {
            $rate    = $attributes['ratings'];
            $query->whereHas('comments',function ($q) use ($rate){
                $q->whereIn('rate',$rate);
            });
        }

        if(isset($attributes['durations']))
        {
            $query->whereIn('total_hours',$attributes['durations']);
        }

        $query = $query->where('status',$this->model::ACTIVE)->where('steps','three')->orderBy('id',isset($attributes['orderBy']) ? $attributes['orderBy'] : 'DESC')->paginate(5);
        return $query;
    }



}
