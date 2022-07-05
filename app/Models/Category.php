<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UploadTrait;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Collection;
class Category extends Model
{
    use UploadTrait , HasTranslations;


    protected $fillable = [
        'name',
        'metadata',
        'description',
        'icon',
        'views',
        'parent_id'
    ];
    public $translatable = ['name','metadata', 'description'];


    public function users(){
        return $this->belongsToMany('App\Models\User','category_users');
    }
    public function childes(){
        return $this->hasMany(self::class,'parent_id');
    }

    public function parent(){
        return $this->belongsTo(self::class,'parent_id');
    }

    public function subChildes()
    {
        return $this->childes()->with( 'subChildes' );
    }

    public function subParents()
    {
        return $this -> parent()->with('subParents');
    }

    public function getAllParentsText()
    {
        $parent         = $this->parent;
        $text[]         = ['name' => $this->name , 'id' => $this->id];
        while(!is_null($this))
        {
            if($parent)
            {
                $text[] = ['name' =>    $parent->getTranslation('name','ar')   , 'id' => $parent->id] ;
            }
            return $text;
        }
    }

    public function getAllParents()
    {
        $text            = $this->name;
        $parent          = $this->parent;

        while(!is_null($parent)) {
            $text       .= $parent ?  ' >> '.  $parent->getTranslation('name','ar') :'' ;
            return  $text;
        }

        return $text;
    }

    public function getAllChildren ()
    {

        $sections         = new Collection();
        foreach ($this->childes as $section) {
            $sections->push($section);
            $sections     = $sections->merge($section->getAllChildren());
         }
        return $sections;
    }

    public function setIconAttribute($value)
    {
        if(is_file($value))
            $this->attributes['icon'] =  $this->uploadFile($value , 'categories');
        else
            $this->attributes['icon'] =  $this->uploadBase64($value , 'categories');
    }

    public function CategoryUser(){
        return $this->hasMany('App\Models\CategoryUser','category_users','user_id','category_id');
    }

    public function categoryViews(){
        return $this->hasMany('App\Models\CategoryView');
    }

    public function getIconAttribute($value)
    {
        return setUrl('storage/images/categories/',$value);
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function courses(){
        return $this->hasMany('App\Models\Course');
    }
}
