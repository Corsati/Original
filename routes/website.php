<?php


use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//*** Comments  ***//
  # Auth::logout();
  # Auth::loginUsingId(127);
  # session()->flush();
  # if(is_null(session()->get('language')))
  # session()->put('language',substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
//*** End Comments ***//

Route::group( [ 'middleware' => [ 'localization'] ] , function () {
    Auth::routes(['verify'   => true]);
});

// email verification after register
Route::get('email/verify/{id}/{hash}'           , 'Auth\VerifyEmailController')
    ->middleware(['signed'                          , 'throttle:6,1' , 'localization'])
    ->name('verification.verify');

// reset password get routes
Route::get('reset-password/{token}'             , function ($token) {
   return view('website.auth.reset-password'   ,compact('token'));
})->middleware(['guest'])->name('password.reset');



Route::group( [ 'namespace'  => 'Website'            ,         'as' => 'coursati.'   ,'middleware' => [ 'localization' , 'seo'] ], function () {


    Route::get('index'                           ,  'HomeController@index')                          ->name('index');
    Route::any('category-courses'               ,  'HomeController@categoryCourses')                ->name('category-courses');
    Route::get('popular-categories'              ,  'HomeController@popularCategories')              ->name('popularCategories');
    Route::any('popular-courses'                 ,  'HomeController@popularCourses')                 ->name('popularCourses');
    Route::any('coursesByLevel'                  ,  'HomeController@coursesByLevel')                 ->name('coursesByLevel');
    Route::get('courses/{id}/{name}'             ,  'HomeController@category')                       ->name('category');
    Route::any('search'                          ,  'HomeController@searchResults')                  ->name('search');
    Route::any('viewAll'                         ,  'HomeController@viewAll')                        ->name('viewAll');

    Route::post('sign-up'                        ,  'UserController@storeUser')                      ->name('sign-up');
    Route::get('instructor-courses/{id}'         ,  'UserController@instructorCourses')              ->name('instructorCourses');

    Route::post('getCities'                      ,  'SettingController@getCities')                   ->name('countries.cities');
    Route::post('password/email'                 ,  'UserController@forgot')                         ->name('forgot');
    Route::post('reset-password'                  , 'UserController@reset')                          ->name('password.update');
    Route::post('bestCourses'                    ,  'CourseController@bestCourses')                  ->name('bestCourses');
    Route::get('language'                        ,  'SettingController@language')                    ->name('language');

    Route::get('course-details/{id}/{name?}/{room?}'
                                                     ,  'CourseController@courseDetails')                ->name('courseDetails');


    Route::group(['middleware' => ['guest']]
                                                     , function () {
            Route::post('register'               ,  'UserController@store')                          ->name('register');
            Route::post('userLogin'              ,  'UserController@userLogin')                      ->name('userLogin');
            Route::get('teach-on-coursati'       ,  'UserController@teachOnCoursati')                ->name('teachOnCoursati');
            Route::post('store-tech-Coursati'    ,  'UserController@store')                          ->name('storeTechCoursati');
            Route::get('login/{provider}'        ,  'SocialController@redirect');
            Route::get('login/{provider}/callback', 'SocialController@Callback');


        });

    Route::group(['middleware' => ['web-auth']]
                                                     , function () {
            Route::post('save-token'             ,  'UserController@saveToken')                      ->name('save-token');
            Route::get('sendPush'                ,  'UserController@sendPush')                       ->name('sendPush');
        });
    Route::get('logout'                          ,  'UserController@logout')                         ->name('logout');

    Route::group(['middleware' => ['web-auth'        , 'verified']]
                                                     , function () {
            Route::get('teachQualifications'     ,  'UserController@teachQualifications')            ->name('teachQualifications');
            Route::get('upgradeToInstructor'     ,  'UserController@upgradeToInstructor')            ->name('upgradeToInstructor');
            Route::post('upgradeTechCoursati'    ,  'UserController@upgradeTechCoursati')            ->name('upgradeTechCoursati');
            Route::get('cart'                    ,  'CartController@cart')                           ->name('cart');
            Route::post('favourite'              ,  'CourseController@favourite')                    ->name('favourite');
            Route::post('addToCart'              ,  'CartController@addToCart')                      ->name('addToCart');
            Route::post('deleteItem'             ,  'CartController@deleteItem')                     ->name('deleteItem');
            Route::post('completeCourse'         ,  'CourseController@completeCourse')               ->name('completeCourse');
            Route::post('complete-purchase'      ,  'CartController@completePurchase')               ->name('completePurchase');
            Route::get('myCourses'               ,  'CourseController@myCourses')                    ->name('myCourses');
            Route::get('favourites'              ,  'CourseController@favourites')                   ->name('favourites');
            Route::get('notifications'           ,  'HomeController@notifications')                  ->name('notifications');
            Route::get('buyNow/{id}'             ,  'CartController@buyNow')                         ->name('buyNow');
            Route::get('myInbox'                 ,  'HomeController@myInbox')                        ->name('myInbox');
            Route::get('chatDetails/{id}'        ,  'HomeController@chatDetails')                    ->name('chatDetails');
            Route::get('performance'             ,  'HomeController@performance')                    ->name('performance');
            Route::get('my-resources'               ,  'HomeController@resources')                   ->name('resources');
            Route::get('settings'                ,  'HomeController@settings')                       ->name('settings');
            Route::post('closeAccount'           ,  'UserController@closeAccount')                   ->name('closeAccount');
            Route::post('sendChatMessage'        ,  'ChatController@sendChatMessage')                ->name('sendChatMessage');
            Route::post('inbox'                  ,  'ChatController@inbox')                          ->name('inbox');
            Route::post('taskSubmit'             ,  'CourseController@taskSubmit')                   ->name('taskSubmit');


            Route::group(['middleware' => ['instructor']], function () {
            Route::get('teacher-dashboard'       ,  'UserController@teacherDashboard')                ->name('teacherDashboard');
            Route::get('choose-category'         ,  'UserController@chooseCategory')                  ->name('chooseCategory');
            Route::get('delete-course/{id}'      ,  'CourseController@deleteCourse')                  ->name('deleteCourse');
            Route::get('create-course/{id}/{name?}/{courseId?}'
                                                     ,  'CourseController@create')                        ->name('createCourse');
            Route::get('create-step-two/{id}'
                                                     ,  'CourseController@createStepTwo')                 ->name('createStepTwo');
            Route::get('create-step-three/{id}'
                                                     ,  'CourseController@createStepThree')               ->name('createStepThree');
            });
            Route::get('my-course/{id}/{name?}'  ,  'CourseController@myCourse')                      ->name('myCourse');
            Route::post('updateUserSettings'     ,  'UserController@updateUserSettings')              ->name('updateUserSettings');
            Route::post('comment'                ,  'CourseController@comment')                       ->name('comment');
            Route::post('storeCourse'            ,  'CourseController@storeCourse')                   ->name('storeCourse');
            Route::post('storeCourseTwo'         ,  'CourseController@storeCourseTwo')                ->name('storeCourseTwo');
            Route::post('storeStepThree'         ,  'CourseController@storeStepThree')                ->name('storeStepThree');
            Route::post('deleteBenefits'         ,  'CourseController@deleteBenefits')                ->name('deleteBenefits');
            Route::get('deleteCertificate/{id}'  ,  'CourseController@deleteCertificate')             ->name('deleteCertificate');
            Route::get('courses'                 ,  'CourseController@courses')                       ->name('courses');


           
            Route::get('home'                    ,  'HomeController@index')                           ->name('home');
            Route::get('profile'                 ,  'UserController@profile')                         ->name('profile');
            Route::post('profile/{id}'           ,  'UserController@editProfile')                     ->name('edit-profile');
            Route::post('edit-password/{id}'      ,  'UserController@editPassword')                   ->name('edit-password');
            Route::delete('delete/{id}'          ,  'UserController@destroy')                         ->name('delete');



            Route::get('course-requirement'      , function (){
                return view('website.course-components.requirements');
            })->name('courseRequirement');
            Route::get('coursati.benefits'       , function (){
                return view('website.course-components.benefits');
            })->name('benefits');
            Route::get('coursati.contents'       , function (){
                return view('website.course-components.contents');
            })->name('contents');
            Route::get('coursati-certificates/{id}'       , function ($id){
                return view('website.course-components.certificates',compact('id'));
            })->name('certificates');
            Route::get('course-lectures/{id}/{index}'         , function ($id,$index){
                return view('website.course-components.lectures',compact('id','index'));
            })->name('courseLectures');
            Route::get('course-lectures-content/{id}/{index}'
                , function ($id,$index){
                    return view('website.course-components.lecture-content',compact('id','index'));
                })->name('courseLecturesContent');

        });
    Route::post('storeTeachQualifications'       ,  'UserController@storeTeachQualifications')        ->name('storeTeachQualifications');

    /*********************** End Route TechOnCoursati *********************/



    /****************** Settings ******************/
    Route::get('about-us'                        , 'SettingController@about')                         ->name('aboutUs');
    Route::get('help'                            , 'SettingController@help')                          ->name('help');
    Route::get('contact-us'                      , 'SettingController@contactUs')                     ->name('contactUs');
    Route::post('contact-us'                     , 'SettingController@contactUsSend')                 ->name('contactUsSend');
    Route::get('advertise'                       , 'SettingController@advertise')                     ->name('advertise');
    Route::get('term'                            , 'SettingController@term')                          ->name('term');
    Route::get('privacy-policy'                  , 'SettingController@policy')                        ->name('policy');
    Route::get('cookie-policy'                   , 'SettingController@cookie')                        ->name('cookie');
    /****************** End Setting *****************/


     /***************** Categories ******************/

    Route::get('subcategory/{id}/{name?}'        , 'CategoryController@showSubCategories')           ->name('subcategory');
    Route::get('subSubCategory/{id}/{name?}'     , 'CategoryController@subSubCategory')           ->name('subSubCategory');
    Route::get('explore-categories'              , 'CategoryController@exploreCategories')           ->name('explore-categories');
    Route::post('filterByRate'                   , 'CourseController@filterByRate')                  ->name('filterByRate');

     /***************** End Categories ******************/





     /********************** Website Route *******************************/

    Route::get('userDashboard', function (){
        return view('website.auth.normalUser.userDashboard');
    })->name('userDashboard');



    /*********************** Views *********************/
    Route::get('website-instructor-teachings/{index}',function ($index){
        return view('website.instructor-components.teachings',compact('index'));
    });
    Route::get('website-instructor-academics/{index}',function ($index){
        return view('website.instructor-components.academics',compact('index'));
    });

    Route::post('autocomplete'               ,  'HomeController@autocomplete')      ->name('autocomplete');


});

//https://dev.to/olawanle_joel/certificate-generator-with-php-using-imagettftext-function-1glh