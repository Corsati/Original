<?php

namespace App\Repositories\Eloquent;

use App\Models\City;
use App\Repositories\Interfaces\ICity;


class CityRepository extends AbstractModelRepository implements ICity
{


    public function __construct(City $model)
    {
        parent::__construct($model);
    }

    public function getByCountryId($attributes){

       return $this->model->where("country_id", $attributes)->get();
    }


}
