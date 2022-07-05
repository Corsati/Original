<?php

namespace App\Repositories\Eloquent;

use App\Models\ContactUsType;
use App\Repositories\Interfaces\IContactType;

class ContactTypeRepository extends AbstractModelRepository implements IContactType
{

    public function __construct(ContactUsType $model)
    {
        parent::__construct($model);
    }
}
