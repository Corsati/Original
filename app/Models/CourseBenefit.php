<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CourseBenefit extends Model
{
    use  HasTranslations;
    protected $fillable = [
        'name',
        'course_id',
    ];

    public $translatable = ['name'];

}
