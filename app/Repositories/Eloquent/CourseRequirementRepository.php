<?php

namespace App\Repositories\Eloquent;

use App\Models\CourseRequirement;
use App\Repositories\Interfaces\ICourseRequirement;


class CourseRequirementRepository extends AbstractModelRepository implements ICourseRequirement
{

    public function __construct(CourseRequirement $model )
    {
        parent::__construct($model);
    }



}
