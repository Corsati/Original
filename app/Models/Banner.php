<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UploadTrait;

class Banner extends Model
{
    use  UploadTrait;

    protected $fillable = [
        'name',
        'active'
    ];

    public function getNameAttribute($value)
    {
        return  url('public/storage/images/banners/'. $value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name']    =  $this->uploadFile($value   , 'banners');
    }
}
