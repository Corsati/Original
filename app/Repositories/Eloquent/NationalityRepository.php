<?php

namespace App\Repositories\Eloquent;

use App\Models\Nationality;
use App\Repositories\Interfaces\INationality;


class NationalityRepository extends AbstractModelRepository implements INationality
{


    public function __construct(Nationality $model)
    {
        parent::__construct($model);
    }

}
