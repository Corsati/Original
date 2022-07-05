<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface ICategory extends IModelRepository
{
    public function main();
    public function popular();
    public function subcategories($id);
    public function getMain();
    public function getPluck($ids);

    }
