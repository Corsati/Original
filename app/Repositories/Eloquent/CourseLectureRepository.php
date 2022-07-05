<?php

namespace App\Repositories\Eloquent;

use App\Models\CourseLecture;
use App\Repositories\Interfaces\ICourseLecture;


class CourseLectureRepository extends AbstractModelRepository implements ICourseLecture
{


    public function __construct(CourseLecture $model)
    {
        parent::__construct($model);
    }

}
