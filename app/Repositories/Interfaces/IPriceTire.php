<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface IPriceTire extends IModelRepository
{
 public function pricesRange($attributes);
}
