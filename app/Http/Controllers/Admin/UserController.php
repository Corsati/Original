<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\Create;
use App\Http\Requests\Admin\Admin\CreateUser;
use App\Http\Requests\Admin\Admin\Update;
use App\Http\Requests\Website\User\UpgradeToInstructor;
use App\Models\AcademicLevel;
use App\Models\City;
use App\Models\Country;
use App\Models\UserCourse;
use App\Repositories\Interfaces\ICourse;
use App\Repositories\Interfaces\IQualification;
use App\Repositories\Interfaces\IRole;
use App\Repositories\Interfaces\IUser;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CategoryUser;
use App\Repositories\Interfaces\ICategory;
use App\Repositories\Interfaces\ICity;
use App\Repositories\Interfaces\ICountry;
use App\Repositories\Interfaces\INationality;
use App\Repositories\Interfaces\ITeachingCategory;
use Carbon\Carbon;
use DB;
class UserController extends Controller
{
    protected $userRepo, $roleRepo , $cityRepo , $countryRepo , $categoryRepo, $nationalityRepo , $courseRepo;

    public function __construct(
        IUser $user,
        IRole $role,
        ICourse $course,
        ICity $city,
        ICountry $country ,
        ICategory $category,
        INationality $nationalityRepo,
        IQualification $qualificationRepo,
        ITeachingCategory $teachingCategoryRepo,
        AcademicLevel $academicModel)
    {
        $this->userRepo             = $user;
        $this->roleRepo             = $role;
        $this->countryRepo          = $country;
        $this->categoryRepo         = $category;
        $this->cityRepo             = $city;
        $this->nationalityRepo      = $nationalityRepo;
        $this->qualificationRepo    = $qualificationRepo;
        $this->teachingCategoryRepo = $teachingCategoryRepo;
        $this->academicRepo         = $academicModel;
        $this->courseRepo           = $course;
    }

    /***************************  get all users  **************************/
    public function index()
    {
        $objects                    = $this->userRepo->users(User::STUDENT);
        $countries                  = $this->countryRepo->get();
        $cities                     = $this->cityRepo->get();
        $categories                 = $this->categoryRepo->get();
        $academics                  = $this->academicRepo->get();
        $newUsers                   = User::whereNull('role_id')->whereDate('created_at', Carbon::today())->count();
        $fromDate                   = Carbon::now()->subDay()->startOfWeek()->toDateString();
        $tillDate                   = Carbon::now()->toDateString();
        $thisWeek                   = User::whereBetween( DB::raw('date(created_at)'), [$fromDate, $tillDate] )->count();
        $lastWeek                   = User::whereBetween( DB::raw('date(created_at)'), [Carbon::now()->subdays(15),Carbon::now()->subdays(7)] )->count();
        return view('admin.users.index', compact('objects','countries','cities','categories','newUsers','thisWeek','lastWeek','academics'));
    }


    /***************************  store user **************************/
    public function store(CreateUser $request)
    {
        $data                       = array_filter($request->all());
        $data['user_type']          = User::STUDENT;
        $user                       = $this->userRepo->store($data);

        if(isset($request['tags']))
            foreach ($request['tags'] as $tag)
                CategoryUser::firstOrCreate(['user_id' => $user->id],['user_id' => $user->id , 'category_id' => $tag]);


        return redirect()->back()->with('success', 'added successfully');
    }


    /***************************  update user  **************************/
    public function update(Update $request, $id)
    {
        $data                        = array_filter($request->all());
        $user                        = $this->userRepo->findOrFail($id);
        $this->userRepo->update($user,$data);

        if(isset($request['tags']))
            foreach ($request['tags'] as $tag)
               CategoryUser::firstOrCreate(['user_id' => $user->id],['user_id' => $user->id , 'category_id' => $tag]);

        return redirect()->back()->with('success', 'updated successfully');
    }

    /***************************  delete user  **************************/
    public function destroy($id)
    {
        $role                        = $this->userRepo->findOrFail($id);
        $this->userRepo->softDelete($role);
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    /***************************  delete qualification  **************************/
    public function qualificationsDelete($id)
    {
        $qualification               = $this->qualificationRepo->findOrFail($id);
        $this->qualificationRepo->delete($qualification);
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    /***************************  delete qualification  **************************/
    public function teachingCategories($id)
    {
        $teachingCategoryRepo        = $this->teachingCategoryRepo->findOrFail($id);
        $this->teachingCategoryRepo->delete($teachingCategoryRepo);
        return redirect()->back()->with('success', 'Deleted successfully');
    }


    /***************************  upgrade get profile page  **************************/
    public function upgrade($id)
    {
        $object                      = $this->userRepo->findOrFail($id);
        $countries                   = $this->countryRepo->get();
        $cities                      = $this->cityRepo->get();
        $categories                  = $this->categoryRepo->get();
        $nationalities               = $this->countryRepo->get();
        return view($object->instructor ? 'admin.instructors.edit-instructor' :'admin.users.upgrade-profile', compact('object','countries','cities','categories','nationalities'));
    }


    /***************************  upgradeUser post request profile  **************************/
    public function upgradeToInstructor(UpgradeToInstructor $request)
    {
        $this->userRepo->upgradeToInstructor($request->all());
        return redirect()->route('admin.users.index')->with('success', 'updated successfully');
    }

    public function profile($id){
        $object                     = $this->userRepo->find($id);
        $academics                  = $this->academicRepo->get();
        $countries                  = $this->countryRepo->get();
        $cities                     = $this->cityRepo->get();
        $courses                    = UserCourse::where('user_id',$id)->get();
        return view('admin.users.profile',compact('object','academics','countries','cities','courses'));
    }

    public function activate($id){
        $object                     = $this->userRepo->find($id);
        $object->update(['email_verified_at' => \Carbon\Carbon::now()]);
        return redirect()->back()->with('success', 'Account Activated');

    }
}
