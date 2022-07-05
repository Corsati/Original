<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use App\Models\Favourite;

class User extends Authenticatable implements MustVerifyEmail
{

    use HasFactory , Notifiable , UploadTrait;

    const ADMIN        = 1;
    const STUDENT      = 2;
    const INSTRUCTOR   = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable= [
        'id',
        'first_name',
        'last_name',
        'phone',
        'uuid',
        'academic_level_id',
        'accepted',
        'about',
        'email',
        'email_verified_at',
        'password',
        'active',
        'banned',
        'avatar',
        'role_id',
        'updated_at',
        'country_id',
        'city_id',
        'date',
        'birth_date',
        'user_type',
        'provider',
        'provider_id',
        'code',
        'device_token',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function instructor(){
        return $this->hasOne('App\Models\Instructor');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category','category_users');
    }

    public function qualifications(){
        return $this->hasMany('App\Models\Qualification');
    }

    public function teaching_categories(){
        return $this->hasMany('App\Models\TeachingCategory');
    }

    public function academicLevel(){
        return $this->hasOn('App\Models\AcademicLevel');
    }

    public function role()
    {
        return $this->belongsTo(Role::class)->withTrashed();
    }

    public function getAvatarAttribute($value)
    {
        if($this->attributes['provider'])
        {
            return $value;
        }
        return setUrl('storage/images/users/',$value);

    }

    public function setAvatarAttribute($value)
    {
        if(is_file($value))
            $this->attributes['avatar'] =  $this->uploadFile($value , 'users');
        else
            $this->attributes['avatar'] =  $value ;
    }

    public function setUuidAttribute($value)
    {
        $this->attributes['uuid']       = createRandomUuid();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password']   = bcrypt($value);
    }



    public function courses()
    {
        return $this->hasMany('App\Models\Course');
    }

    public function cart()
    {
        return $this->hasMany(Carts::class);
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function userCourses()
    {
        return $this->hasMany(UserCourse::class);
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function setting(){
        return $this->hasOne(UserSetting::class);
    }
}
