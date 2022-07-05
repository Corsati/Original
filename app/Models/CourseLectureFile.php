<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\UploadTrait;

class CourseLectureFile extends Model
{
    use HasTranslations,UploadTrait;
    protected $fillable = [
        'name',
        'file',
        'content_file_type',
        'video_id',
        'video_time',
        'course_lecture_id'
    ];
    public $translatable = ['name'];

}
