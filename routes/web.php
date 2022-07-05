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
//Auth::logout();

Route::group( [   'middleware' => [ 'localization','seo'] ], function () {
    Route::get('/'                                   ,  'Website\HomeController@index')                          ->name('coursati.indexGuest');


    Route::get('admin-course-requirement/{index}',function ($index){
        return view('admin.course-components.requirements',compact('index'));
    });

    Route::get('admin-course-lectures/{index}/{key}',function ($index,$key){
        return view('admin.course-components.lectures',compact('index','key'));
    });

    Route::get('admin-course-benefits/{index}',function ($index){
        return view('admin.course-components.benefits',compact('index'));
    });

    Route::get('admin-course-contents/{index}',function ($index){
        return view('admin.course-components.contents',compact('index'));
    });

    Route::get('admin-course-certificates/{index}',function ($index){
        return view('admin.course-components.certificates',compact('index'));
    });

    Route::get('admin-user-qualifications/{index}',function ($index){
        return view('admin.user-components.qualifications',compact('index'));
    });

    Route::get('admin-user-teachings/{index}',function ($index){
        return view('admin.user-components.teachings',compact('index'));
    });

    Route::get('admin-course-lectures-files/{index}/{key}',function ($index,$key){
        return view('admin.course-components.lectures-files',compact('index','key'));
    });

});
Route::group( [ 'namespace'  => 'Website'            ,        'as' => 'coursati.'   ,'middleware' => [ 'localization'] ], function () {
    Route::group( [      'middleware' => [ 'localization', 'web-auth'  , 'verified'] ], function () {
    Route::get('home' , 'HomeController@index')->name('homePage');
    Route::get('index', 'HomeController@index')->name('indexPage');
});
});
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'  ], function () {

    Route::get( 'Login'          , 'AuthController@showLoginForm')->name('show.login');
    Route::get( 'login'          , 'AuthController@showLoginForm')->name('show.login');
    Route::post('login'          , 'AuthController@login')->name('login');
    Route::post('logout'         , 'AuthController@logout')->name('logout');
    Route::post('getCities'      , 'HomeController@getCities')->name('countries.cities');


    Route::group(['middleware' => ['admin', 'check-role' , 'localization']], function () {

        /*------------ start Of Dashboard----------*/
        Route::get('dashboard', [
            'uses'      => 'HomeController@dashboard',
            'as'        => 'dashboard',
            'icon'      => '<i class="nav-icon fa fa-home"></i>',
            'title'     => 'home',
            'type'      => 'parent'
        ]);

        /*------------ start Of Roles----------*/
        Route::get('roles', [
            'uses'      => 'RoleController@index',
            'as'        => 'roles.index',
            'title'     => 'roles',
            'icon'      => '<i class="nav-icon fa fa-book"></i>',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['roles.create', 'roles.store', 'roles.edit', 'roles.update', 'roles.delete']
        ]);

        #add role page
        Route::get('roles/create', [
            'uses'      => 'RoleController@create',
            'as'        => 'roles.create',
            'title'     => 'add_role',

        ]);

        #store role
        Route::post('roles/store', [
            'uses'      => 'RoleController@store',
            'as'        => 'roles.store',
            'title'     => 'store_role'
        ]);

        #edit role page
        Route::get('roles/{id}/edit', [
            'uses'      => 'RoleController@edit',
            'as'        => 'roles.edit',
            'title'     => 'edit_role'
        ]);

        #update role
        Route::put('roles/{id}', [
            'uses'      => 'RoleController@update',
            'as'        => 'roles.update',
            'title'     => 'update_role'
        ]);

        #delete role
        Route::delete('roles/{id}', [
            'uses'      => 'RoleController@destroy',
            'as'        => 'roles.delete',
            'title'     => 'delete_role'
        ]);


        /************ Admins ************/
        Route::get('admins', [
            'as'        => 'admin.index',
            'icon'      => '   <i class="nav-icon fa fa-address-book"></i>   ',
            'title'     => 'supervisors',
            'type'      => 'parent',
            'uses'      => 'AdminController@index',
            'child'     => [
                'admins.store',
                'admins.update',
                'admins.delete' ,
            ]
        ]);

        #store
        Route::post('admins/store', [
            'uses'      => 'AdminController@store',
            'as'        => 'admins.store',
            'title'     => 'add_supervisors'
        ]);
        #update
        Route::post('admins/{id}', [
            'uses'      => 'AdminController@update',
            'as'        => 'admins.update',
            'title'     => 'edit_supervisors'
        ]);
        #delete
        Route::delete('admins/{id}', [
            'uses'      => 'AdminController@destroy',
            'as'        => 'admins.delete',
            'title'     => 'edit_supervisor'
        ]);
        /************ End Admins ************/

        /************ End Users ************/

        #show
        Route::get('admins/users', [
            'uses'      => 'UserController@index',
            'as'        => 'users.index',
            'title'     => 'users',
            'type'      => 'parent',
            'icon'      => ' <i class="fa fa-graduation-cap"></i> ',
            'child'     => [
                'users.store',
                'users.update',
                'users.upgrade',
                'users.delete',
                'users.profile',
                'users.activate',
                'users.upgradeToInstructor',
                'qualifications.delete',
                'teaching_categories.delete'
            ]
        ]);

        #store
        Route::post('users/store', [
            'uses'      => 'UserController@store',
            'as'        => 'users.store',
            'title'     => 'add_user'
        ]);
        #update
        Route::post('users/{id}', [
            'uses'      => 'UserController@update',
            'as'        => 'users.update',
            'title'     => 'edit_user'
        ]);
        #profile
        Route::get('profile/{id}', [
            'uses'      => 'UserController@profile',
            'as'        => 'users.profile',
            'title'     => 'page_user'
        ]);
        #activate
        Route::get('activate/{id}', [
            'uses'      => 'UserController@activate',
            'as'        => 'users.activate',
            'title'     => 'activate_account'
        ]);
        #upgrade
        Route::get('users/upgrade/{id}', [
            'uses'      => 'UserController@upgrade',
            'as'        => 'users.upgrade',
            'title'     => 'page_from_user_to_trainer'
        ]);
        Route::post('users-upgrade-instructors', [
            'uses'      => 'UserController@upgradeToInstructor',
            'as'        => 'users.upgradeToInstructor',
            'title'     => 'teach'
        ]);

        #delete
        Route::delete('qualifications/delete/{id}', [
            'uses'      => 'UserController@qualificationsDelete',
            'as'        => 'qualifications.delete',
            'title'     => 'delete_course_detail'
        ]);
        Route::delete('teaching-categories/delete/{id}', [
            'uses'      => 'UserController@teachingCategories',
            'as'        => 'teaching_categories.delete',
            'title'     => 'delete_technical_detail'
        ]);

        #delete
        Route::delete('users/{id}', [
            'uses'      => 'UserController@destroy',
            'as'        => 'users.delete',
            'title'     => 'delete_student'
        ]);

        #instrutors
        Route::get('admins/instructors', [
            'uses'      => 'InstructorController@index',
            'as'        => 'instructors.index',
            'type'      => 'parent',
            'title'     => 'instructors',
            'icon'      => '<i class="nav-icon fa fa-chalkboard-teacher"></i>',
            'child'     => ['instructors.profile','instructors.upgradeToInstructor']
        ]);

        #upgrade
        Route::get('instructors/profile/{id}', [
            'uses'      => 'InstructorController@profile',
            'as'        => 'instructors.profile',
            'title'     => 'instructor_profile'
        ]);

        #post upgrade
        Route::post('instructors-profile', [
            'uses'      => 'InstructorController@upgradeToInstructor',
            'as'        => 'instructors.upgradeToInstructor',
            'title'     => 'instructor_profile_edit'
        ]);


        /*------------ start Of categories Controller ----------*/

        Route::get('admins/categories', [
            'uses'      => 'CategoryController@index',
            'as'        => 'categories.index',
            'title'     => 'categories',
            'icon'      => '<i class="nav-icon fa fa-th-list"></i>',
            'sub_route' => true,
            'type'      => 'parent',
            'child'     => [
                'categories.store',
                'categories.update',
                'categories.delete' ,
                'categories.delete' ,
                'categories.main',
                'categories.sub'
            ]
        ]);

        #main categories
        Route::get('main-categories', [
            'uses'      => 'CategoryController@main',
            'as'        => 'categories.main',
            'type'      => 'child',
            'title'     => 'main_categories',
            'icon'  => '<i class="nav-icon fa fa-archive"></i>',
        ]);

        #sub categories
        Route::get('sub-categories/{id?}', [
            'uses'      => 'CategoryController@subCategories',
            'as'        => 'categories.sub',
            'type'      => 'child',
            'title'     => 'sub_categories',
            'icon'  => '<i class="nav-icon fa fa-archive"></i>',
        ]);

        Route::post('categories/store', [
            'uses'      => 'CategoryController@store',
            'as'        => 'categories.store',
            'title'     => 'add_categories'
        ]);

        #update countries
        Route::post('categories/edit/{id}', [
            'uses'      => 'CategoryController@update',
            'as'        => 'categories.update',
            'title'     => 'edit_categories'
        ]);

        #delete
        Route::delete('categories/{id}', [
            'uses'      => 'CategoryController@destroy',
            'as'        => 'categories.delete',
            'title'     => 'delete_categories'
        ]);
    });

    /*------------ start Of courses Controller ----------*/

    Route::get('admins/courses', [
        'uses'      => 'CourseController@index',
        'as'        => 'courses.index',
        'title'     => 'courses',
        'icon'      => '<i class="nav-icon fa fa-play-circle"></i>',
        'type'      => 'parent',
        'sub_route' => true,
        'child'     => [
            'courses.all',
            'courses.pending',
            'courses.inReview',
            'courses.active',
            'courses.changeStatus',
            'courses.add',
            'courses.store',
            'courses.update',
            'courses.display',
            'courses.show',
            'courses.delete' ,
            'courses.video' ,
            'courses.addLectureFile' ,
            'courses.certificate.delete',
            'courses.contents.delete',
            'courses.lectures.delete',
            'courses.benefits.delete' ,
        ]
    ]);

    Route::get('courses/courses/index', [
        'uses'      => 'CourseController@index',
        'as'        => 'courses.all',
        'title'     => 'all_courses',
        'icon'      => '<i class="nav-icon fa fa-stop"></i>',
    ]);
    Route::get('courses/pending', [
        'uses'      => 'CourseController@pending',
        'as'        => 'courses.pending',
        'title'     => 'pending_courses',
        'icon'      => '<i class="nav-icon fa fa-stop"></i>',
    ]);
    Route::get('courses/in_review', [
        'uses'      => 'CourseController@inReview',
        'as'        => 'courses.inReview',
        'title'     => 'in_review_courses',
        'icon'      => '<i class="nav-icon fa fa-step-backward"></i>',
    ]);
    Route::get('courses/active', [
        'uses'      => 'CourseController@active',
        'as'        => 'courses.active',
        'title'     => 'active_courses',
        'icon'      => '<i class="nav-icon fa fa-toggle-on"></i>',
    ]);
    Route::get('courses/add', [
        'uses'      => 'CourseController@add',
        'as'        => 'courses.add',
        'title'     => 'add_courses'
    ]);
    Route::get('courses/show/{id}', [
        'uses'      => 'CourseController@display',
        'as'        => 'courses.display',
        'title'     => 'show_courses'
    ]);
    Route::get('courses/category/show/{id}', [
        'uses'      => 'CourseController@show',
        'as'        => 'courses.show',
        'title'     => 'show_courses'
    ]);
    Route::get('courses/change-status/{id}', [
        'uses'      => 'CourseController@changeStatus',
        'as'        => 'courses.changeStatus',
        'title'     => 'change-status'
    ]);
    Route::get('courses/video/{id}', [
        'uses'      => 'CourseController@video',
        'as'        => 'courses.video',
        'title'     => 'show_videos'
    ]);
    Route::post('courses/store', [
        'uses'      => 'CourseController@store',
        'as'        => 'courses.store',
        'title'     => 'add_courses'
    ]);
    Route::post('courses/addLectureFile', [
        'uses'      => 'CourseController@addLectureFile',
        'as'        => 'courses.addLectureFile',
        'title'     => 'add_lecture'
    ]);
    #update countries
    Route::post('courses/edit/{id}', [
        'uses'      => 'CourseController@update',
        'as'        => 'courses.update',
        'title'     => 'edit_courses'
    ]);
    #delete
    Route::delete('courses/{id}', [
        'uses'      => 'CourseController@destroy',
        'as'        => 'courses.delete',
        'title'     => 'delete_courses'
    ]);
    #delete
    Route::delete('benefits/{id}', [
        'uses'      => 'CourseController@courseBenefitDelete',
        'as'        => 'courses.benefits.delete',
        'title'     => 'delete_benefits'
    ]);
    #delete
    Route::delete('certificate/{id}', [
        'uses'      => 'CourseController@courseCertificateDelete',
        'as'        => 'courses.certificate.delete',
        'title'     => 'delete_certificate'
    ]);
    #delete
    Route::delete('contents/{id}', [
        'uses'      => 'CourseController@courseContentDelete',
        'as'        => 'courses.contents.delete',
        'title'     => 'delete_contents'
    ]);
    #delete
    Route::delete('lectures/{id}', [
        'uses'      => 'CourseController@courseLectureDelete',
        'as'        => 'courses.lectures.delete',
        'title'     => 'delete_lectures'
    ]);
    Route::post('lectures/edit/{id}', [
        'uses'      => 'CourseController@update_lec',
        'as'        => 'courses.lectures.update',
        'title'     => 'edit_lectures'
    ]);
    Route::post('benefits/edit/{id}', [
        'uses'      => 'CourseController@update_benefit',
        'as'        => 'courses.benefits.update',
        'title'     => 'edit_benefits'
    ]);
    Route::post('contents/edit/{id}', [
        'uses'      => 'CourseController@update_content',
        'as'        => 'courses.contents.update',
        'title'     => 'edit_contents'
    ]);
    Route::post('certificates/edit/{id}', [
        'uses'      => 'CourseController@update_certificate',
        'as'        => 'courses.certificates.update',
        'title'     => 'edit_certificates'
    ]);
    Route::post('lectures/update/{id}', [
        'uses'      => 'CourseController@update_lecture_files',
        'as'        => 'lectures.update',
        'title'     => 'edit_lectures'
    ]);
    Route::delete('requirements/{id}', [
        'uses'      => 'CourseController@courseRequirementDelete',
        'as'        => 'courses.requirements.delete',
        'title'     => 'delete_requirements'
    ]);
    Route::post('requirements/edit/{id}', [
        'uses'      => 'CourseController@update_req',
        'as'        => 'courses.requirements.update',
        'title'     => 'edit_requirements'
    ]);
    Route::delete('lecture-files/{id}', [
        'uses'      => 'CourseController@courseLectureFileDelete',
        'as'        => 'courses.lecture_files.delete',
        'title'     => 'delete_lecture_files'
    ]);

    Route::delete('comments/{id}', [
        'uses'      => 'CourseController@courseCommentDelete',
        'as'        => 'courses.comments.delete',
        'title'     => 'comments'
    ]);


    /*------------ start Of banners Controller ----------*/


//    Route::get('admins/banners', [
//        'uses'      => 'BannerController@index',
//        'as'        => 'banners.index',
//        'title'     => 'banners',
//        'icon'      => '<i class="nav-icon fa fa-film"></i>',
//        'type'      => 'parent',
//        'child'     => [
//            'banners.store',
//            'banners.delete' ,
//            'banners.activate' ,
//
//        ]
//    ]);
//
//    Route::post('banners/store', [
//        'uses'      => 'BannerController@store',
//        'as'        => 'banners.store',
//        'title'     => 'add_banner'
//    ]);
//
//    #delete
//    Route::delete('banners/{id}', [
//        'uses'      => 'BannerController@destroy',
//        'as'        => 'banners.delete',
//        'title'     => 'delete_banner'
//    ]);
//    #activate
//    Route::get('banners-activate/{id}', [
//        'uses'      => 'BannerController@activate',
//        'as'        => 'banners.activate',
//        'title'     => 'delete_activate'
//    ]);


    /*------------ start contact us ----------*/
    Route::get('contact_us', [
        'uses'      => 'ContactUsController@index',
        'as'        => 'contact_us.index',
        'title'     => 'contact_us_messages',
        'icon'      => '<i class="fa fa-comment"></i>',
        'type'      => 'parent',
        'sub_route' => false,
        'child'     => [ 'contact_us.show', 'contact_us.delete']
    ]);

    #show
    Route::get('contact_us/{id}', [
        'uses'  => 'ContactUsController@show',
        'as'    => 'contact_us.show',
        'title' => 'show_contact_us_messages'
    ]);

    #delete
    Route::delete('contact_us/{id}', [
        'uses'  => 'ContactUsController@destroy',
        'as'    => 'contact_us.delete',
        'title' => 'delete_contact_us_messages'
    ]);

    /*------------ start offers ----------*/
    Route::get('offers', [
        'as'        => 'offers',
        'title'     => 'offers',
        'icon'      => '<i class="fa fa-play"></i>',
        'type'      => 'parent',
        'sub_route' => true,
        'child'     => ['offers.store','offers.update','offers.delete','offers.home','offers.index','offers.status']
    ]);

    /*------------ start offers ----------*/
    Route::get('user-offers', [
        'uses'      => 'OfferController@home',
        'as'        => 'offers.home',
        'title'     => 'offers',
        'type'      => 'child',
        'icon'  => '<i class="nav-icon fa fa-camera"></i>',
    ]);
    Route::get('guest-offers', [
        'uses'      => 'OfferController@index',
        'as'        => 'offers.index',
        'title'     => 'offers-guest',
        'type'      => 'child',
        'icon'  => '<i class="nav-icon fa fa-camera"></i>',
    ]);
    Route::get('offers/{id}', [
        'uses'      => 'OfferController@status',
        'as'        => 'offers.status',
        'title'     => 'offers-status',
    ]);

    #show
    Route::post('offers/store', [
        'uses'      => 'OfferController@store',
        'as'        => 'offers.store',
        'title'     => 'offers_store'
    ]);

    #update
    Route::put('offers-update-offer/{id}', [
        'uses'      => 'OfferController@update',
        'as'        => 'offers.update',
        'title'     => 'offers_store'
    ]);

    #delete
    Route::delete('offers/{id}', [
        'uses'     => 'OfferController@destroy',
        'as'       => 'offers.delete',
        'title'    => 'delete_offer'
    ]);


    /*------------ start Of Settings ----------*/
    Route::get('settings', [
        'uses'      => 'SettingController@index',
        'as'        => 'settings.index',
        'title'     => 'settings',
        'icon'      => '<i class="fa fa-cogs"></i>',
        'type'      => 'parent',
        'sub_route' => false,
        'child'     => ['settings.update','settings.message.all','settings.message.one','settings.send_email']
    ]);

    #update
    Route::put('settings', [
        'uses'      => 'SettingController@update',
        'as'        => 'settings.update',
        'title'     => 'update_settings'
    ]);

    #message all
    Route::post('settings/{type}/message-all', [
        'uses'      => 'SettingController@messageAll',
        'as'        => 'settings.message.all',
        'title'     => 'message_all'
    ])->where('type','email|sms|notification');

    #message one
    Route::post('settings/{type}/message-one', [
        'uses'      => 'SettingController@messageOne',
        'as'        => 'settings.message.one',
        'title'     => 'message_one'
    ])->where('type','email|sms|notification');

    #send email
    Route::post('settings/send-email', [
        'uses'      => 'SettingController@sendEmail',
        'as'        => 'settings.send_email',
        'title'     => 'send_email'
    ]);

    /*------------ start orders ----------*/
    Route::get('orders', [
        'uses'      => 'OrderController@index',
        'as'        => 'orders.index',
        'title'     => 'orders',
        'icon'      => '<i class="fa fa-money-bill"></i>',
        'type'      => 'parent',
        'sub_route' => false,
        'child'     => [] #'orders.store','orders.update','orders.delete'
    ]);


    /*------------ start Of countries Controller ----------*/


    Route::get('admins/countries', [
        'uses'      => 'CountryController@index',
        'as'        => 'countries.index',
        'title'     => 'countries',
        'icon'      => '<i class="nav-icon fa fa-globe"></i>',
        'type'      => 'parent',
        'child'     => [
            'countries.store',
            'countries.update',
            'countries.delete' ,
        ]
    ]);

    Route::post('countries/store', [
        'uses'      => 'CountryController@store',
        'as'        => 'countries.store',
        'title'     => 'add_countries'
    ]);

    #update countries
    Route::post('countries/edit/{id}', [
        'uses'      => 'CountryController@update',
        'as'        => 'countries.update',
        'title'     => 'edit_categories'
    ]);

    #delete
    Route::delete('countries/{id}', [
        'uses'      => 'CountryController@destroy',
        'as'        => 'countries.delete',
        'title'     => 'delete_countries'
    ]);

    /*------------ start Of cities Controller ----------*/


    Route::get('admins/cities', [
        'uses'      => 'CityController@index',
        'as'        => 'cities.index',
        'title'     => 'cities',
        'icon'      => '<i class="nav-icon fa fa-map-marked"></i>',
        'type'      => 'parent',
        'child'     => [
            'cities.store',
            'cities.update',
            'cities.delete' ,
        ]
    ]);

    Route::post('cities/store', [
        'uses'      => 'CityController@store',
        'as'        => 'cities.store',
        'title'     => 'add_cities'
    ]);

    #update
    Route::post('cities/edit/{id}', [
        'uses'      => 'CityController@update',
        'as'        => 'cities.update',
        'title'     => 'edit_cities'
    ]);

    #delete
    Route::delete('cities/{id}', [
        'uses'      => 'CityController@destroy',
        'as'        => 'cities.delete',
        'title'     => 'delete_cities'
    ]);


    /*------------ start Of levels Controller ----------*/



   Route::get('admins/contactTypes', [
        'uses'      => 'ContactTypesController@index',
        'as'        => 'contactTypes.index',
        'title'     => 'contactTypes',
        'icon'      => '<i class="nav-icon fa fa-allergies"></i>',
        'type'      => 'parent',
        'child'     => [
            'contactTypes.store',
            'contactTypes.update',
            'contactTypes.delete' ,
        ]
    ]);

    Route::post('contactTypes/store', [
        'uses'      => 'ContactTypesController@store',
        'as'        => 'contactTypes.store',
        'title'     => 'add_contact_types'
    ]);

    #update
    Route::post('contactTypes/edit/{id}', [
        'uses'      => 'ContactTypesController@update',
        'as'        => 'contactTypes.update',
        'title'     => 'edit_contact_types'
    ]);

    #delete
    Route::delete( 'contactTypes/{id}', [
        'uses'      => 'ContactTypesController@destroy',
        'as'        => 'contactTypes.delete',
        'title'     => 'delete_contact_types'
    ]);

     Route::get('admins/levels', [
         'uses'      => 'AcademicController@index',
         'as'        => 'levels.index',
         'title'     => 'levels',
         'icon'      => '<i class="nav-icon fa fa-address-card"></i>',
         'type'      => 'parent',
         'child'     => [
             'levels.store',
             'levels.update',
             'levels.delete' ,
         ]
     ]);

     Route::post('levels/store', [
         'uses'      => 'AcademicController@store',
         'as'        => 'levels.store',
         'title'     => 'add_level'
     ]);

     #update
     Route::post('levels/edit/{id}', [
         'uses'      => 'AcademicController@update',
         'as'        => 'levels.update',
         'title'     => 'edit_level'
     ]);

     #delete
     Route::delete('levels/{id}', [
         'uses'      => 'AcademicController@destroy',
         'as'        => 'levels.delete',
         'title'     => 'delete_level'
     ]);


 Route::get('admins/price-tiers', [
         'uses'      => 'PriceController@index',
         'as'        => 'prices.index',
         'title'     => 'prices',
         'icon'      => '<i class="nav-icon fa fa-address-card"></i>',
         'type'      => 'parent',
         'child'     => [
             'prices.store',
             'prices.update',
             'prices.delete' ,
         ]
     ]);

     Route::post('prices/store', [
         'uses'      => 'PriceController@store',
         'as'        => 'prices.store',
         'title'     => 'add_prices'
     ]);

     #update
     Route::post('prices/edit/{id}', [
         'uses'      => 'PriceController@update',
         'as'        => 'prices.update',
         'title'     => 'edit_prices'
     ]);

     #delete
     Route::delete( 'prices/{id}', [
         'uses'      => 'PriceController@destroy',
         'as'        => 'prices.delete',
         'title'     => 'delete_prices'
     ]);

     Route::get('admins/durations', [
         'uses'      => 'DurationController@index',
         'as'        => 'durations.index',
         'title'     => 'duration',
         'icon'      => '<i class="nav-icon fa fa-address-card"></i>',
         'type'      => 'parent',
         'child'     => [
             'durations.store',
             'durations.update',
             'durations.delete' ,
         ]
     ]);

     Route::post('durations/store', [
         'uses'      => 'DurationController@store',
         'as'        => 'durations.store',
         'title'     => 'add_durations'
     ]);

     #update
     Route::post('durations/edit/{id}', [
         'uses'      => 'DurationController@update',
         'as'        => 'durations.update',
         'title'     => 'edit_durations'
     ]);

     #delete
     Route::delete( 'durations/{id}', [
         'uses'      => 'DurationController@destroy',
         'as'        => 'durations.delete',
         'title'     => 'delete_durations'
     ]);



});






Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
