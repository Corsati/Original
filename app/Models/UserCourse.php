<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','course_id'];
    CONST PENDING   = 'PENDING';
    CONST ONGOING   = 'ONGOING';
    CONST COMPLETED = 'COMPLETED';
    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }
}
