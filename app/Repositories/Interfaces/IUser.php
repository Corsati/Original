<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface IUser extends IModelRepository
{

    public function users($type);
    public function instructors();
    public function update(Model $model, $attributes = []);
    public function upgradeToInstructor($attributes);
    public function popular();
    public function ExtraToInstructor($attributes,$useId);
    public function popularUsers($id);
}
