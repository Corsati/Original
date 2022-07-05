<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface ICategoryUser extends IModelRepository
{
    public function remove($id);
    public function updateCategoryUser($id);
}
