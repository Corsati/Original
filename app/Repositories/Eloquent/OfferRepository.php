<?php

namespace App\Repositories\Eloquent;

use App\Models\Offer;
use App\Repositories\Interfaces\IOffer;


class OfferRepository extends AbstractModelRepository implements IOffer
{

    public function __construct(Offer $model)
    {
        parent::__construct($model);
    }

    public function getOffers()
    {
        return $this->model->where('type' , auth()->guest() ? 'guest' : 'auth')->first();
    }
}
