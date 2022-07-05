<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface IModelRepository
{

    public function find($id);

    public function findOrFail($id);

    public function get();

    public function store($attributes = []);

    public function update(Model $model, $attributes = []);

    public function softDelete(Model $model);


}
