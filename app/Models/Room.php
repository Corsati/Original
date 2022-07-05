<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable  = [
        'id',
        'room',
        's_id',
        'r_id',
        'course_id',
        'updated_at'
    ];


    public function course(){
        return $this->belongsTo('App\Models\Course','course_id','id');
    }

    public function chat(){
        return $this->hasMany('App\Models\Chat','room','id');
    }
    public function sender(){
        return $this->belongsTo('App\Models\User','s_id','id');
    }
    public function receiver(){
        return $this->belongsTo('App\Models\User','r_id','id');
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}



