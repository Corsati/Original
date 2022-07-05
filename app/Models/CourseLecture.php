<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CourseLecture extends Model
{
    use HasTranslations ;
    protected $fillable = [
        'name',
        'course_id',
    ];

    protected $translatable = ['name'];

    public function lectureFiles(){
        return $this->hasMany('App\Models\CourseLectureFile');
    }
}
