<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UploadTrait;

class Instructor extends Model
{
    use UploadTrait;
    protected $fillable = [
        'gender',
        'address',
        'identification',
        'identification_img',
        'language',
        'iban_number',
        'bank_name',
        'bio',
        'nationality',
        'user_id'
    ];

    public function setIdentificationImgAttribute($value)
    {
        if(is_file($value))
            $this->attributes['identification_img'] =  $this->uploadFile($value   , 'identifications');
        else
            $this->attributes['identification_img'] =  $this->uploadBase64($value , 'identifications');
    }

    public function nationality(){
        return $this->belongsTo(Nationality::class,'nationality','id');
    }

    public function getIdentificationImgAttribute($value)
    {
        return setUrl('storage/images/identifications/',$value);
    }


    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
