<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AcademicLevel extends Model
{
    use HasFactory , HasTranslations;

    protected $fillable  = [
        'name',
    ];
    public $translatable = ['name'];

    public function courses()
    {
        return $this->hasMany(Course::class,'level');
    }
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

}
