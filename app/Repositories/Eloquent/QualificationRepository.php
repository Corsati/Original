<?php

namespace App\Repositories\Eloquent;

use App\Models\Qualification;
use App\Repositories\Interfaces\IQualification;


class QualificationRepository extends AbstractModelRepository implements IQualification
{


    public function __construct(Qualification $model)
    {
        parent::__construct($model);
    }

}
