<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UploadTrait;
use Spatie\Translatable\HasTranslations;

class Course extends Model
{
    use UploadTrait , HasTranslations;

    const ACTIVE        = 'active';
    const IN_REVIEW     = 'in_review';
    const PENDING       = 'pending';

    protected $fillable = [
        'image',
        'promotional_video',
        'title',
        'description',
        'price',
        'discount',
        'language',
        'user_id',
        'category_id',
        'promotional_video_id',
        'status',
        'views',
        'video_time',
        'steps',
        'level',
        'total_hours',
    ];

    public $translatable = ['title','description'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }





    public function getImageAttribute($value)
    {
        if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
            return asset('/storage/images/courses/'.$value);
        }
        return $value;
    }

    public function setImageAttribute($value)
    {
        if ($value != null)
        {
            if(is_file($value))
            {
                $this->attributes['image'] = $this->uploadFile($value, 'courses');
                return;
            }
            $this->attributes['image']     = $value;
        }
    }





    public function duration(){
        return $this->belongsTo('App\Models\Duration','total_hours');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function level()
    {
        return $this->belongsTo('App\Models\AcademicLevel','level');
    }

    public function rates()
    {
        return $this->hasMany('App\Models\CourseRate');
    }

    public function benefits()
    {
        return $this->hasMany('App\Models\CourseBenefit');
    }

    public function certificates()
    {
        return $this->hasMany('App\Models\CourseCertificate');
    }

    public function contents()
    {
        return $this->hasMany('App\Models\CourseContent');
    }

    public function lectures()
    {
        return $this->hasMany('App\Models\CourseLecture');
    }

    public function requirements()
    {
        return $this->hasMany('App\Models\CourseRequirement');
    }

    public function lecturesFiles()
    {
        return $this->hasMany('App\Models\CourseLectureFile');
    }

    public function userCourses()
    {
        return $this->hasMany(UserCourse::class);
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function rooms()
    {
        return $this->hasMany('App\Models\Room');
    }

   public function categories()
    {
        return $this->hasMany('App\Models\CourseCategory');
    }



}
