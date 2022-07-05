<?php

namespace App\Repositories\Eloquent;

use App\Models\Favourite;
use App\Repositories\Interfaces\IFavourite;


class FavouriteRepository extends AbstractModelRepository implements IFavourite
{

    public function __construct(Favourite $model)
    {
        parent::__construct($model);
    }
}
