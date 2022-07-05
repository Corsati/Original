<?php

namespace App\Repositories\Eloquent;

use App\Models\PriceTire;
use App\Repositories\Interfaces\IPriceTire;


class PriceTireRepository extends AbstractModelRepository implements IPriceTire
{

    public function __construct(PriceTire $model)
    {
        parent::__construct($model);
    }
    public function pricesRange($attributes){
        return $this->model->whereIn('id',$attributes)->pluck('price');
    }
}
