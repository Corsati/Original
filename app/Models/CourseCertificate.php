<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Traits\UploadTrait;

class CourseCertificate extends Model
{
    use UploadTrait , HasTranslations;

    protected $fillable = [
        'title',
        'details',
        'file',
        'file_type',
        'course_id',
    ];
    public $translatable = ['title' ,'details'];





    public function getFileAttribute($value)
    {
        if (filter_var($value, FILTER_VALIDATE_URL) === FALSE) {
            return asset('/storage/images/courses_certificates/'.$value);
        }
        return $value;
    }

    public function setFileAttribute($value)
    {
        if ($value != null)
        {
            if(is_file($value))
            {
                $this->attributes['file'] = $this->uploadFile($value, 'courses_certificates');
                return;
            }
            $this->attributes['file']     = $value;
        }
    }
}
