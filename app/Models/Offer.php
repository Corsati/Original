<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UploadTrait;
use Spatie\Translatable\HasTranslations;

class Offer extends Model
{
    use UploadTrait , HasTranslations;
    protected $fillable = [
        'image',
        'image_ar',
        'title',
        'type',
        'sub_title',
        'description',
        'expire_date',
        'expire_date',
        'open_counter',
    ];
    public $translatable = ['title','description','sub_title'];

    public function getImageAttribute($value)
    {
        return  url('storage/images/offers/'. $value);
    }

    public function setImageAttribute($value)
    {
            $this->attributes['image']             =  $this->uploadFile($value   , 'offers');
    }

    public function getImageArAttribute($value)
    {
        return  url('storage/images/offers/'. $value);
    }

    public function setImageArAttribute($value)
    {
        $this->attributes['image_ar']          =  $this->uploadFile($value   , 'offers');
    }


    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
