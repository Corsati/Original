<?php

namespace App\Repositories\Eloquent;

use App\Models\Banner;
use App\Repositories\Interfaces\IBanner;

class BannerRepository extends AbstractModelRepository implements IBanner
{


    public function __construct(Banner $model)
    {
        parent::__construct($model);
    }

}
