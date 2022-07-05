<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\Create;
use App\Http\Requests\Admin\Admin\UpdateProfile;
use App\Models\AcademicLevel;
use App\Models\Instructor;
use App\Repositories\Interfaces\IQualification;
use App\Repositories\Interfaces\IRole;
use App\Repositories\Interfaces\IUser;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\Interfaces\ICategory;
use App\Repositories\Interfaces\ICity;
use App\Repositories\Interfaces\ICountry;
use App\Repositories\Interfaces\INationality;
use App\Repositories\Interfaces\ITeachingCategory;
use Carbon\Carbon;
use DB;
class InstructorController extends Controller
{

    protected $userRepo, $roleRepo , $cityRepo , $countryRepo , $categoryRepo, $nationalityRepo;

    public function __construct(
        IUser $user,
        ICity $city,
        ICountry $country ,
        ICategory $category,
        INationality $nationalityRepo,
        IQualification $qualificationRepo,
        AcademicLevel $academicModel  ,
        ITeachingCategory $teachingCategoryRepo)
    {
        $this->userRepo             = $user;
        $this->countryRepo          = $country;
        $this->categoryRepo         = $category;
        $this->cityRepo             = $city;
        $this->nationalityRepo      = $nationalityRepo;
        $this->qualificationRepo    = $qualificationRepo;
        $this->teachingCategoryRepo = $teachingCategoryRepo;
        $this->academicRepo         = $academicModel;
    }

    /***************************  get all users  **************************/
    public function index()
    {
        $objects                    = $this->userRepo->instructors();
        $countries                  = $this->countryRepo->get();
        $cities                     = $this->cityRepo->get();
        $categories                 = $this->categoryRepo->get();
        $newUsers                   = User::where('user_type',User::INSTRUCTOR)->whereDate('created_at', Carbon::today())->count();

        $fromDate                   = Carbon::now()->subDay()->startOfWeek()->toDateString();
        $tillDate                   = Carbon::now()->toDateString();
        $thisWeek                   = User::where('user_type',User::INSTRUCTOR)->whereBetween( DB::raw('date(created_at)'), [$fromDate, $tillDate] )->count();
        $lastWeek                   = User::where('user_type',User::INSTRUCTOR)->whereBetween( DB::raw('date(created_at)'), [Carbon::now()->subdays(15),Carbon::now()->subdays(7)] )->count();
        return view('admin.instructors.index', compact('objects','countries','cities','categories','newUsers','thisWeek','lastWeek'));
    }


    /***************************  store user **************************/
    public function store(Create $request)
    {
        $data                       = array_filter($request->all());
        $data['user_type']          = User::INSTRUCTOR;
        $user                       = $this->userRepo->store($data);


        if(isset($request['tags']))
            foreach ($request['tags'] as $tag)
                $user->categoryUser()->attach([$tag]);


        return redirect()->back()->with('success', 'added successfully');
    }

    /***************************  upgrade profile  **************************/
    public function profile($id)
    {
        $object                     = $this->userRepo->findOrFail($id);
        $countries                  = $this->countryRepo->get();
        $cities                     = $this->cityRepo->get();
        $categories                 = $this->categoryRepo->get();
        $academics                  = $this->academicRepo->get();
        return view( 'admin.instructors.edit-instructor', compact('object','countries','cities','categories','academics'));
    }

    /***************************  upgradeUser post request profile  **************************/
    public function upgradeToInstructor(Request $request)
    {
        $this->userRepo->upgradeToInstructor($request->all());
        return redirect()->back()->with('success', 'updated successfully');
    }

    /***************************  delete user  **************************/
    public function destroy($id)
    {
        $role                       = $this->userRepo->findOrFail($id);
        $this->userRepo->softDelete($role);
        return redirect()->back()->with('success', 'Deleted successfully');
    }

}
