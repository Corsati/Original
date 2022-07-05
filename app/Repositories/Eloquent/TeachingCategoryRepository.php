<?php

namespace App\Repositories\Eloquent;

use App\Models\TeachingCategory;
use App\Repositories\Interfaces\ITeachingCategory;


class TeachingCategoryRepository extends AbstractModelRepository implements ITeachingCategory
{


    public function __construct(TeachingCategory $model)
    {
        parent::__construct($model);
    }


}
