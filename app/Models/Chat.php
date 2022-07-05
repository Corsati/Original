<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $guarded   = ['id'];
    protected $fillable  = ['room','message','seen','s_id','type','updated_at'];


    public function sender(){
        return $this->belongsTo('App\Models\User','s_id');
    }
    public function chatRoom(){
        return $this->belongsTo('App\Models\Room','room','id');
    }
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}



