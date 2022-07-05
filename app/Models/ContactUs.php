<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'contact_us_type_id',
    ];

    public function type(){
        return $this->belongsTo('App\Models\ContactUsType','contact_us_type_id');
    }
}
