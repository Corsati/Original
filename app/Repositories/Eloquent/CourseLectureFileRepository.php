<?php

namespace App\Repositories\Eloquent;

use App\Models\CourseLectureFile;
use App\Repositories\Interfaces\ICourseLectureFile;


class CourseLectureFileRepository extends AbstractModelRepository implements ICourseLectureFile
{


    public function __construct(CourseLectureFile $model)
    {
        parent::__construct($model);
    }

    public function findByVideoId($id)
    {
       return $this->model->where('video_id', $id)->first() ;
    }
}
