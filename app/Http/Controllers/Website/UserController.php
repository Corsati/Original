<?php
namespace App\Http\Controllers\Website;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Website\User\AddTrainerExtraData;
    use App\Http\Requests\Website\User\NormalUser;
    use App\Http\Requests\Website\User\Update;
    use App\Http\Requests\Website\User\EditPasswordRequest;
    use App\Http\Requests\Website\User\UpgradeToInstructor;
    use App\Http\Requests\Website\User\Create;
    use App\Http\Requests\Website\User\Login;
    use App\Models\Offer;
    use App\Models\City;
    use App\Notifications\SystemNotification;
    use App\Repositories\Interfaces\IAcademic;
    use App\Repositories\Interfaces\ICity;
    use App\Repositories\Interfaces\ICountry;
    use App\Repositories\Interfaces\ICourse;
    use App\Repositories\Interfaces\IUser;
    use App\Repositories\Interfaces\IOffer;
    use App\Repositories\Interfaces\ICategory;
    use App\Repositories\Interfaces\INationality;
    use App\Repositories\Interfaces\ICategoryUser;
    use Illuminate\Auth\Events\PasswordReset;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use DB;
    use App;
    use Illuminate\Support\Facades\Password;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Str;
    use Notification;

class UserController extends Controller
{
    protected $userRepo, $nationalityRepo, $categoryRepo, $cityRepo, $academicRepo, $offerRepo, $courseRepo, $countryRepo, $categoryUserRepo;

    public function __construct(
        ICategoryUser $categoryUser,
        IUser $user,
        IOffer $offer,
        ICity $city,
        ICountry $country,
        IAcademic $academic,
        INationality $nationality,
        ICategory $category,
        ICourse $course

    )
    {
        $this->categoryUserRepo = $categoryUser;
        $this->userRepo = $user;
        $this->nationalityRepo = $nationality;
        $this->categoryRepo = $category;
        $this->countryRepo = $country;
        $this->cityRepo = $city;
        $this->offerRepo = $offer;
        $this->academicRepo = $academic;
        $this->courseRepo = $course;

        $offer                      = Offer::where('type' , auth()->guest() ? 'guest' : 'auth')->first();
        view()->share('offer',$offer);

    }


    public function storeUser(NormalUser $request)
    {
        $data = array_filter($request->validated());
        $user = $this->userRepo->store($data);
        Auth::login($user);
        \auth()->user()->sendEmailVerificationNotification();
        return response()->json(['url' => route('coursati.index')]);
    }


    public function teachOnCoursati()
    {
        $nationalities = $this->nationalityRepo->get();
        $countries = $this->countryRepo->get();
        $cities = $this->cityRepo->get();
        $categories = $this->categoryRepo->get();
        return view('website.auth.instructor.teach-on-coursati', compact('categories', 'nationalities', 'countries', 'cities'));
    }

    public function upgradeToInstructor()
    {
        $nationalities = $this->nationalityRepo->get();
        $countries = $this->countryRepo->get();
        $cities = $this->cityRepo->getByCountryId(\auth()->user()->country_id);
        return view('website.auth.instructor.upgrade-account', compact('nationalities', 'countries', 'cities'));
    }

    public function upgradeTechCoursati(UpgradeToInstructor $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $this->userRepo->upgradeToInstructor($data + ['id' => \auth()->id()]);
        });

        $details = [
            'subject' => __('web.upgradeAccount'),
            'greeting' => __('web.Hi') . ' ' . auth()->user()->first_name,
            'body' => __('web.upgradeAccount'),
            'thanks' => __('web.thanksToUse'),
            'actionText' => __('web.visitUs'),
            'actionURL' => url('/'),
            'course_id' => null,
            'room_id' => null,
            'type' => 'admin',
        ];

        Notification::send(\auth()->user(), new SystemNotification($details));
        return response()->json(['url' => route('coursati.teachQualifications')]);
    }

    public function store(Create $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $user = $this->userRepo->store($data);
            $this->userRepo->upgradeToInstructor($data + ['id' => $user->id]);
            Auth::login($user);
            \auth()->user()->sendEmailVerificationNotification();
        });
        return response()->json(['url' => route('coursati.teachQualifications')]);
    }

    public function userLogin(Login $request)
    {
        if (auth()->guard()->attempt(['email' => $request['email'], 'password' => $request['password']], true)){
            return response()->json(['status' => true]);
        }

        else
            return response()->json(['status' => false, 'msg' => __('web.invalidAuth')]);

    }

    public function home()
    {
        return view('website.site.home');
    }

    public function profile()
    {
        $countries  = $this->countryRepo->get();
        $cities     = City::whereCountryId(\auth()->user()->country_id)->get();
        $categories = $this->categoryRepo->get();
        return view('website.auth.normalUser.profile', compact('countries', 'cities', 'categories'));
    }

    public function editProfile(Update $request)
    {
        $data = array_filter($request->validated());
        $id   = Auth::id();
        $user = $this->userRepo->findOrFail($id);
        $this->userRepo->update($user, $data);

        if (!is_null($request['category_id'])) {
            foreach ($request['category_id'] as $cat)
                $this->categoryUserRepo->updateCategoryUser($cat);
        }

        if (!is_null($request['bank_name']) && !is_null($request['iban_number'])) {
             auth()->user()->instructor()->update(['bank_name' => $request['bank_name'] , 'iban_number' => $request['iban_number']]);
        }

        return response()->json(['url' => route('coursati.index')]);
    }
    public function editPassword(EditPasswordRequest $request){
        $user = $this->userRepo->findOrFail(Auth::id());
        if (!\Hash::check($request['old_password'], $user->password)){
            return response()->json(['status' => false, 'msg' => __('web.incorrect_pass')]);
        }else{
            $user->update(['password' => $request['password']]);
            return response()->json(['status' => true, 'url' => route('coursati.index')]);
        }
    }

    public function teacherDashboard()
    {
        if (\auth()->user()->qualifications()->count() == 0) {
            return redirect()->route('coursati.teachQualifications');
        }
        return view('website.auth.instructor.teacherDashboard');
    }

    public function instructorCourses($id)
    {
        $this->userRepo->findOrFail($id);
        $courses = $this->courseRepo->instructorCourses($id);
        return view('website.site.courses.instructor-courses', compact('courses'));
    }

    public function getCities(City $request)
    {
        $cities = $this->cityRepo->getByCountryId($request['country_id']);
        return response()->json($cities);
    }

    public function teachQualifications()
    {
        $categories = $this->categoryRepo->get();
        $academics = $this->academicRepo->get();
        return view('website.auth.instructor.teachQualifications', compact('categories', 'academics'));
    }

    public function chooseCategory()
    {
        return view('website.auth.instructor.choose-category');
    }

    public function storeTeachQualifications(AddTrainerExtraData $request)
    {
        $this->userRepo->ExtraToInstructor($request->validated(), auth()->id());
        return response()->json(['url' => route('coursati.teacherDashboard')]);
    }

    public function destroy($id)
    {
        $this->categoryUserRepo->remove($id);
        return response()->json(['url' => route('coursati.index')]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }

    public function updateUserSettings(Request $request)
    {
        $setting = \auth()->user()->setting;
        if ($setting) {
            if ($request->has('chat')) {
                $setting->chat = 1;
            } else {
                $setting->chat = 0;
            }

            if ($request->has('purchases')) {
                $setting->purchase = 1;
            } else {
                $setting->purchase = 0;
            }

            if ($request->has('course')) {
                $setting->course_status = 1;
            } else {
                $setting->course_status = 0;
            }


            $setting->save();


        }
        Session::flush('success', __('web.updated'));
        return redirect()->back();
    }

    public function closeAccount()
    {
        $details = [
            'subject'   => __('web.closeAccount'),
            'greeting'  => __('web.Hi') . ' ' . auth()->user()->first_name,
            'body'      => __('web.closeAccountMsg'),
            'thanks'    => __('web.thanksToUse'),
            'actionText'=> __('web.visitUs'),
            'actionURL' => url('/'),
            'course_id' => null,
            'type'      => 'admin',
        ];

        Notification::send(\auth()->user(), new SystemNotification($details));

        \auth()->user()->update(['banned' => 1]);
        return response()->json([]);
    }


    public function forgot()
    {
        $credentials = request()->validate(['email' => 'required|email|exists:users,email']);
        Password::sendResetLink($credentials);
        session()->flash('success', __('web.reset-send'));
        return redirect()->route('coursati.index');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
        $status = Password::broker($request['broker'])->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => $password
                ])->save();

                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );
        session()->flash('code', 'reset');
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('coursati.index')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }


    public function saveToken(Request $request)
    {
        auth()->user()->update(['device_token' => $request->token]);
    }




}


