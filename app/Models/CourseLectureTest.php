<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\UploadTrait;

class CourseLectureTest extends Model
{
    use HasTranslations , UploadTrait;
    protected $fillable = [
        'name',
        'file',
        'content_file_type',
        'course_lecture_id',
    ];

    protected $translatable = ['name'];


    public function getFileAttribute($value){
        return  url('public/storage/videos/courses/'. $value);
    }

    public function setFileAttribute($value)
    {
        $this->attributes['file']  =  $this->uploadFile($value   , 'courses_tests');
    }

}
