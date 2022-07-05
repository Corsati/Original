<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishedLecture extends Model
{
    use HasFactory;

    protected $fillable = ['progress','completed','course_lecture_file_id','user_id'];
}
