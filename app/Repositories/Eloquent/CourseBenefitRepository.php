<?php

namespace App\Repositories\Eloquent;

use App\Models\CourseBenefit;
use App\Repositories\Interfaces\ICourseBenefit;


class CourseBenefitRepository extends AbstractModelRepository implements ICourseBenefit
{


    public function __construct(CourseBenefit $model)
    {
        parent::__construct($model);
    }


}
