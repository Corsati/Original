<?php

namespace App\Repositories\Eloquent;

use App\Models\CourseContent;
use App\Repositories\Interfaces\ICourseContent;


class CourseContentRepository extends AbstractModelRepository implements ICourseContent
{


    public function __construct(CourseContent $model)
    {
        parent::__construct($model);
    }

}
