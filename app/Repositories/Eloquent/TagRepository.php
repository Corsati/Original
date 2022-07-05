<?php

namespace App\Repositories\Eloquent;

use App\Models\Tags;
use App\Repositories\Interfaces\ITag;


class TagRepository extends AbstractModelRepository implements ITag
{

    public function __construct(Tags $model)
    {
        parent::__construct($model);
    }
}
