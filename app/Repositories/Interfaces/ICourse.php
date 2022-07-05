<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface ICourse extends IModelRepository
{
    public function getCourses($type,$ids = []);
    public function categoryCourses($id,$take);
    public function addFavourite($id);
    public function getCoursesByCategory($id);
    public function storeStepThree($attributes);
    public function popular($id);
    public function coursesByRate($attributes);
    public function complete($attributes);
    public function instructorCourses($id);
    public function bestCourses($id);
    public function search($attributes);
    public function randomCourse($id);

    }
