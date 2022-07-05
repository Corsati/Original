<?php

namespace App\Repositories\Eloquent;

use App\Models\CategoryUser;
use App\Repositories\Interfaces\ICategoryUser;
use Illuminate\Support\Facades\Auth;

class CategoryUserRepository extends AbstractModelRepository implements ICategoryUser
{


    public function __construct(CategoryUser $model)
    {
        parent::__construct($model);
    }

    public function remove($id){
        $this->model->where(['category_id' => $id , 'user_id' => Auth::id() ])->delete();
    }

    public function updateCategoryUser($id)
    {
        $this->model::updateOrCreate(['user_id' => Auth::id() , 'category_id' => $id]);
    }

}
