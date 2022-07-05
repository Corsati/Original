<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CourseRequirement extends Model
{
    use HasTranslations;
    protected $fillable = [
        'name',
        'course_id',
    ];
    protected $translatable = ['name'];
}
