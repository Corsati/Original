<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeachingCategory extends Model
{
    protected $fillable = [
        'experience_years',
        'experience_level',
        'description',
        'user_id',
        'category_id',
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}
