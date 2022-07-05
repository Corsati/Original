<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UploadTrait;

class Qualification extends Model
{
    use UploadTrait;
    protected $fillable = [
        'title',
        'details',
        'proof_image',
        'user_id',
    ];


    public function setProofImageAttribute($value)
    {
        if(is_file($value))
            $this->attributes['proof_image'] =  $this->uploadFile($value  , 'proofs');
        else
            $this->attributes['proof_image'] =  $this->uploadBase64($value , 'proofs');
    }

    public function getProofImageAttribute($value)
    {
        return  url('public/storage/images/proofs/'. $value);
    }
}
