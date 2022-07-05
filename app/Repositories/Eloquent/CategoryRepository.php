<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Interfaces\ICategory;

class CategoryRepository extends AbstractModelRepository implements ICategory
{


    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function popular()
    {
       $categories =  $this->model::whereHas('categoryViews',function ($q){
        })->inRandomOrder()->whereNotNull('parent_id')->take(8)->get()->sortByDesc(function($views) {
            return $views->categoryViews->count();
        });
        if(count($categories) == 0)
           return $this->model->inRandomOrder()->take(10)->get();
       else
           return $categories;
    }

    public function main(){
        return $this->model->whereNull('parent_id')->inRandomOrder()->take(13)->get();
    }

    public function subcategories($id){
        return $this->model->whereParentId($id)->inRandomOrder()->get();
    }

    public function getMain(){
        return $this->model->whereNull('parent_id') ->take(10)->inRandomOrder()->get() ;
    }

    public function random(){
        return $this->model->inRandomOrder()->first()->id ;
    }

    public function getPluck($ids){
        return $this->model->whereIn('id',$ids)->get();
    }


}
