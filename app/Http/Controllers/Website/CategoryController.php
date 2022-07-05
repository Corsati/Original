<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Repositories\Interfaces\ICategory;
use App\Models\Category;
use App\Repositories\Interfaces\ICourse;
use App\Repositories\Interfaces\IDuration;
use App\Repositories\Interfaces\IUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CategoryController extends Controller
{

    protected  $categoryRepo;
    protected  $userRepo;
    protected  $durationRepo;

    public function __construct( ICategory $category , IUser $user, ICourse $course, IDuration $duration)
    {
        $this->categoryRepo      = $category;
        $this->userRepo          = $user;
        $this->courseRepo        = $course;
        $this->durationRepo      = $duration;
        $offer                      = Offer::where('type' , auth()->guest() ? 'guest' : 'auth')->first();
        view()->share('offer',$offer);

    }

    /***************************  get all categories  **************************/
    public function showCategories($id)
    {
        $category                = Category::findOrFail($id);
        $categories              = Category::where('parent_id',$id)->get();
        return view('website.site.categories.category',compact('categories','category'));
    }

    public function showSubCategories($id)
    {
        $category                = $this->categoryRepo ->findOrFail($id);
        $categories              = $this->categoryRepo ->main();
        $durations               = $this->durationRepo ->get();
        $users                   = $this->userRepo     ->popularUsers($id);
        $courses                 = $this->courseRepo    ->categoryCourses($id,isset($request['take'])?$request['take']:null);
        return view('website.site.categories.subCategory',compact('categories','category','users','durations','courses'));
    }


   public function subSubCategory($id)
    {
        $category                = $this->categoryRepo ->findOrFail($id);
        $categories              = $this->categoryRepo ->main();
        $durations               = $this->durationRepo ->get();
        $users                   = $this->userRepo     ->popularUsers($id);
        $recommended             = $this->courseRepo   ->randomCourse($id);
        return view('website.site.categories.subSubCategory',compact('categories','category','users','durations','recommended'));
    }

    public function exploreCategories(){
        return view('website.site.categories.exploreCategories');
    }



}
