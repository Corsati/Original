<?php

namespace App\Repositories\Eloquent;

use App\Models\Carts;
use App\Models\Course;
use App\Repositories\Interfaces\ICart;


class CartRepository extends AbstractModelRepository implements ICart
{


    protected $course;
    public function __construct(Carts $model, Course $course)
    {
        parent::__construct($model);
        $this->course = $course;
    }

    public function addCart($id){
        $isCart       = $this->model->where('user_id', auth()->id())->where('course_id',$id)->first();
        if(!$isCart)
        {
            $this->model->create(
                [   'user_id'              => auth()->id() ,
                    'course_id'            => $id,
                    'price'                => discountCourse($this->course->find($id)->price,$this->course->find($id)->discount)]);
            return true;
        }
        else
            $isCart->delete();


        return false;
    }
}
