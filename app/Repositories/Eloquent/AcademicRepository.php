<?php

namespace App\Repositories\Eloquent;

use App\Models\AcademicLevel;
use App\Models\Category;
use App\Repositories\Interfaces\IAcademic;

class AcademicRepository extends AbstractModelRepository implements IAcademic
{


    public function __construct(AcademicLevel $model)
    {
        parent::__construct($model);
    }

}
