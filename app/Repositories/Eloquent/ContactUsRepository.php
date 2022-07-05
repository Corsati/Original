<?php

namespace App\Repositories\Eloquent;

use App\Models\ContactUs;
use App\Repositories\Interfaces\IContactUs;


class ContactUsRepository extends AbstractModelRepository implements IContactUs
{
    public function __construct(ContactUs $model)
    {
        parent::__construct($model);
    }

}
