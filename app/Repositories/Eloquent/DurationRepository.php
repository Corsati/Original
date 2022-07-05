<?php

namespace App\Repositories\Eloquent;

use App\Models\Duration;
use App\Repositories\Interfaces\IDuration;


class DurationRepository extends AbstractModelRepository implements IDuration
{

    public function __construct(Duration $model)
    {
        parent::__construct($model);
    }


}
