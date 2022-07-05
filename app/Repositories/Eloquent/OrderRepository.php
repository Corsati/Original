<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Interfaces\IOrder;


class OrderRepository extends AbstractModelRepository implements IOrder
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

}
