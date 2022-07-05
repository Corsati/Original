<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Interfaces\ICategory;
use App\Repositories\Interfaces\ICourse;
use App\Repositories\Interfaces\IUser;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ICountry;
use App\Repositories\Interfaces\ICity;

class HomeController extends Controller
{
    protected $countryRepo, $cityRepo;

    public function __construct(
        ICity                   $city,
        IUser                   $user,
        ICountry                $country,
        ICategory               $category,
        ICourse                 $course)
    {
        $this->countryRepo      = $country;
        $this->cityRepo         = $city;
        $this->userRepo         = $user;
        $this->categoryRepo     = $category;
        $this->courseRepo       = $course;

    }

    /***************** dashboard *****************/
    public function dashboard()
    {
        $categories            = $this->categoryRepo->popular();
        $courses               = $this->courseRepo  ->popular(null);
        $teachers              = $this->userRepo    ->popular();
        $users                 = $this->userRepo    ->popularStudents();
        return view('admin.dashboard.index', compact('categories', 'courses','teachers','users'));
    }

    public function getCities(Request $request)
    {
        $cities                = $this->cityRepo->getByCountryId($request['country_id']);
        return response()->json($cities);
    }
}
