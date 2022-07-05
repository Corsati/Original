<?php

namespace App\Repositories\Eloquent;

use App\Models\FinishedLecture;
use App\Repositories\Interfaces\IFinishedLecture;


class FinishedLectureRepository extends AbstractModelRepository implements IFinishedLecture
{


    public function __construct(FinishedLecture $model)
    {
        parent::__construct($model);
    }

    public function checkIfExists($id){
        return $this->model->where('course_lecture_file_id',$id)->where('user_id',auth()->id())->first();
    }
}
