<?php

namespace App\Repositories\Eloquent;

use App\Models\CourseLectureTest;
use App\Repositories\Interfaces\ICourseLectureTest;


class CourseLectureTestRepository extends AbstractModelRepository implements ICourseLectureTest
{


    public function __construct(CourseLectureTest $model)
    {
        parent::__construct($model);
    }

}
