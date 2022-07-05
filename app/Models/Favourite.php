<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function favourite(){
        return $this->hasOne(Favourite::class);
    }
}
