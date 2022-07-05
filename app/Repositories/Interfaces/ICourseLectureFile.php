<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface ICourseLectureFile extends IModelRepository
{

    public function findByVideoId($id);
}
