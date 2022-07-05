<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCourseTask extends Model
{
    protected $fillable = [
        'course_certificate_id',
        'course_id',
        'task',
        'user_id',
    ];


}
