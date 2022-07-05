<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRate extends Model
{
    protected $fillable = [
        'rate',
        'comment',
        'approved',
        'course_id',
        'user_id',
    ];
}
