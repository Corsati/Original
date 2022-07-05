<?php

namespace App\Repositories\Eloquent;

use App\Models\CourseCertificate;
use App\Repositories\Interfaces\ICourseCertificate;


class CourseCertificateRepository extends AbstractModelRepository implements ICourseCertificate
{


    public function __construct(CourseCertificate $model)
    {
        parent::__construct($model);
    }

}
