<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 use App\Traits\UploadTrait;

class Admin extends Authenticatable
{

    use HasFactory , Notifiable , UploadTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable= [
        'id',
        'name',
        'email',
        'password',
        'avatar',
        'role_id',
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



    public function role()
    {
        return $this->belongsTo(Role::class)->withTrashed();
    }

    public function getAvatarAttribute($value)
    {
        return setUrl('storage/images/users/',$value);

    }

    public function setAvatarAttribute($value)
    {
        if(is_file($value))
            $this->attributes['avatar'] =  $this->uploadFile($value , 'users');
        else
            $this->attributes['avatar'] =  $this->uploadBase64($value , 'users');
    }

    public function setUuidAttribute($value)
    {
        $this->attributes['uuid']       = createRandomUuid();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password']   = bcrypt($value);
    }


}
