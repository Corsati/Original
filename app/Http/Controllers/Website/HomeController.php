<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Course\FindCourse;
use App\Http\Requests\Website\Course\SearchRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Offer;
use App\Repositories\Interfaces\IAcademic;
use App\Repositories\Interfaces\ICategory;
use App\Repositories\Interfaces\ICity;
use App\Repositories\Interfaces\ICountry;
use App\Repositories\Interfaces\ICourse;
use App\Repositories\Interfaces\IDuration;
use App\Repositories\Interfaces\IOffer;
use App\Repositories\Interfaces\IPriceTire;
use App\Repositories\Interfaces\IUser;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected  $categoryRepo , $cityRepo , $offerRepo , $courseRepo, $countryRepo, $userRepo , $academicRepo, $priceTiresRepo, $durationRepo;

    public function __construct(
        ICategory                   $category,
        IOffer                      $offer,
        ICity                       $city,
        ICountry                    $country,
        ICourse                     $course,
        IUser                       $user,
        IPriceTire                  $priceTire,
        IAcademic                   $academic,
        IDuration                   $duration

    )
    {
        $this->categoryRepo         = $category;
        $this->offerRepo            = $offer;
        $this->cityRepo             = $city;
        $this->countryRepo          = $country;
        $this->courseRepo           = $course;
        $this->userRepo             = $user;
        $this->academicRepo         = $academic;
        $this->priceTiresRepo       = $priceTire;
        $this->durationRepo         = $duration;


    }
    public function index()
    {
        seo()->title('Corsati');

        $offer                      = Offer::where('type' , auth()->guest() ? 'guest' : 'auth')->first();
        view()->share('offer',$offer);

        $suggestedCourse            = [ ];
        $suggestedCourses           = [ ];
        $toLearnCourses             = [ ];
        $countries                  = $this->countryRepo        ->get();
        $cities                     = $this->cityRepo           ->get();
        $categories                 = $this->categoryRepo       ->popular();
        $courses                    = $this->courseRepo         ->popular(isset($request['id']) ? $request['id']: null);
        if(!auth()->guest())
        {
            $suggestedCourse            = auth()->user()->categories()->inRandomOrder()->get();
            if($suggestedCourse->first())
                $suggestedCourses       = $this->courseRepo     ->categoryCourses($suggestedCourse->first()?$suggestedCourse->first()->id:$this->categoryRepo->random());

            $toLearnCourses             = $this->courseRepo     ->getCoursesByCategory($suggestedCourse->pluck('id')->toArray());
        }
        return view(auth()->guest()?'website.site.index':'website.site.home', compact('countries', 'cities','suggestedCourse','suggestedCourses','toLearnCourses','courses','categories'));
    }

    public function category($id){
        $category                   = $this->categoryRepo       ->findOrFail($id);
        $categories                 = $this->categoryRepo       ->subcategories($id);
        #$users                     = $this->userRepo           ->popularUsers($id);
        #$courses                   = $this->courseRepo         ->getCoursesByCategory($id);
        $coursesCount               = $this->courseRepo         ->getCoursesByCategoryCount($id);
        #return view('website.site.categories.category',compact('category','categories','users','courses'));
        $name                       = $category->name;
        $data                       = array();
        array_push($data,$id);
        $data ['topics']            = $data ;
        $courses                    = $this->courseRepo         ->search($data);
        $tires                      = $this->priceTiresRepo     ->get();
        $durations                  = $this->durationRepo       ->get();
        return view('website.site.searchResults',compact('courses','name','durations','tires','categories','category','coursesCount'));
    }

    public function categoryCourses(FindCourse $request){

        $courses                    = $this->courseRepo         ->categoryCourses($request['id'],isset($request['take'])?$request['take']:null);
        $render                     = view(  !isset($request['type']) ? 'website.components.courses' :'website.components.category-courses'    ,compact('courses'))->render();
        return response()->json($render);
    }

    public function popularCourses(Request $request){
        $courses                    = $this->courseRepo         ->popular(isset($request['id']) ? $request['id']: null);
        $render                     = view(isset($request['id']) ? 'website.components.popular-category-courses': 'website.components.popular-courses',compact('courses'))->render();
        return response()->json($render);
    }

    public function coursesByLevel(Request $request){
        $courses                    = $this->courseRepo         ->search($request->all());
        $render                     = view( 'website.components.popular-category-courses',compact('courses'))->render();
        return response()->json($render);
    }

    public function notifications(){
        return view('website.auth.notifications');
    }

    public function searchResults(SearchRequest $request)
    {
        $name                       = $request['name_search'] ? $request['name_search']  : '' ;
        $courses                    = $this->courseRepo         ->search($request->validated());
        $tires                      = $this->priceTiresRepo     ->get();
        $durations                  = $this->durationRepo       ->get();
        $render                     = view('website.components.search',compact('courses','durations','tires','name'))->render();
        if(isset($request['ajax']))
        return response()->json($render);
        else
        return view('website.site.searchResults',compact('courses','name','durations','tires'));
    }

    public function popularCategories(){
        $categories                 = $this->categoryRepo       ->main();
        $render                     = view('website.components.popular-categories',compact('categories'))->render();
        return response()->json($render);
    }

    public function myInbox(){
        $courses                    = Course::whereUserId(auth()->id())->whereHas('userCourses')->get();
        return view('website.auth.instructor.myInbox',compact('courses'));
    }

    public function chatDetails($id){
        $course                     = $this->courseRepo         ->findOrFail($id);
        return view('website.auth.instructor.chatDetails',compact('course'));
    }

    public function performance(){
        $categoriesId               = Course::whereUserId(auth()->id())->pluck('category_id');
        $categories                 = Category::whereIn('id',$categoriesId)->whereHas('courses',function ($q){
           $q->whereHas('userCourses');
        })->get();

        return view('website.auth.instructor.performance',compact('categories'));
    }

    public function resources(){
        return view('website.auth.instructor.resources');
    }

    public function settings(){
        return view('website.auth.instructor.settings');
    }

    public function viewAll(){
        $courses                    = $this->courseRepo->courses();
        return view('website.site.courses.viewAll',compact('courses'));
    }

    public function autocomplete(SearchRequest $request)
    {
        $search = $request->search;

        if($search == ''){
            $employees = Course::orderby('name','asc')->select('id','name')->limit(5)->get();
        }else{
            $employees = Course::orderby('title','asc')->select('id','title')->where('title', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = array();
        foreach($employees as $employee){
            $response[] = array("value"=>$employee->id,"label"=>$employee->title);
        }

        return response()->json($response);
    }
}
