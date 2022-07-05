<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface IFinishedLecture extends IModelRepository
{
    public function checkIfExists($id);
}
