<?php


namespace App\Repositories\Eloquent;

use App\Models\CategoryUser;
use App\Models\UserSetting;
use App\Repositories\Interfaces\IModelRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

abstract class AbstractModelRepository implements IModelRepository
{
    public $model;

    /**
     * AbstractModelRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function get()
    {
        return $this->model->latest()->get();
    }

    public function store($attributes = [])
    {
        if (isset($attributes['name_ar'])      && isset($attributes['name_en']))
            $attributes['name']        = $this->setName($attributes['name_ar'], $attributes['name_en']);


       if (isset($attributes['title_ar'])      && isset($attributes['title_en']))
            $attributes['title']       = $this->setTitle($attributes['title_ar'], $attributes['title_en']);


        if (isset($attributes['sub_title_ar']) && isset($attributes['sub_title_en']))
            $attributes['sub_title']   = $this->setName($attributes['sub_title_ar'], $attributes['sub_title_en']);




       if (isset($attributes['description_ar']) && isset($attributes['description_en']))
            $attributes['description'] = $this->setTitle($attributes['description_ar'], $attributes['description_en']);

       if (isset($attributes['metadata_ar'])    && isset($attributes['metadata_en']))
            $attributes['metadata']    = $this->setTitle($attributes['metadata_ar'], $attributes['metadata_en']);



        $user                          =  $this->model->create($attributes);

        if (!empty($attributes))
        {
            if(isset($attributes['category_id']) && is_array($attributes['category_id']))
            {
                foreach ($attributes['category_id'] as $cat)
                    CategoryUser::updateOrCreate(['user_id' => $user->id , 'category_id' => $cat]);
            }
        }

        return $user;

    }


    public function find($id)
    {
        return $this->model->find($id);
    }


    public function update($model ,$attributes = [] )
    {
        if (!empty($attributes)) {

            if (isset($attributes['name_ar']) && isset($attributes['name_en']))
                $attributes['name']        = $this->setName($attributes['name_ar'], $attributes['name_en']);


            if (isset($attributes['title_ar']) && isset($attributes['title_en']))
                $attributes['title']       = $this->setTitle($attributes['title_ar'], $attributes['title_en']);

            if (isset($attributes['sub_title_ar']) && isset($attributes['sub_title_en']))
                $attributes['sub_title'] = $this->setName($attributes['sub_title_ar'], $attributes['sub_title_en']);


            if (isset($attributes['description_ar']) && isset($attributes['description_en']))
                $attributes['description'] = $this->setTitle($attributes['description_ar'], $attributes['description_en']);

            if (isset($attributes['metadata_ar']) && isset($attributes['metadata_en']))
                $attributes['metadata'] = $this->setTitle($attributes['metadata_ar'], $attributes['metadata_en']);


            if(isset($attributes['banned']) && $attributes['banned'] == true )
                $attributes['banned']      = true;
            else
                $attributes['banned']      = false;


            $model->update($attributes);
            return $this->model;
        }
        return $this->model;
    }

    public function softDelete(Model $model)
    {
        return $model->delete();
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }

    public function setName($name_ar, $name_en): array
    {
        return ['en' => $name_en, 'ar' => $name_ar];
    }

    public function setTitle($title_ar, $title_en): array
    {
        return ['en' => $title_en, 'ar' => $title_ar];
    }

    public function setDetails($details_ar, $details_en): array
    {
        return ['en' => $details_en, 'ar' => $details_ar];
    }


    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }
}
