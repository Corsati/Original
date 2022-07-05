<?php

namespace App\Providers;


use App\Models\AcademicLevel;
use App\Models\Category;
use App\Models\Country;
use App\Models\Course;
use App\Models\Nationality;
use App\Models\Offer;
use App\Models\Order;
use App\Observers\AcademicLevelObserver;
use App\Observers\CategoryObserver;
use App\Observers\CountryObserver;
use App\Observers\CourseObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use App\Models\User;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         $loader = AliasLoader::getInstance();
         $loader->alias('Illuminate\Routing\CompileRouteCollection', 'App\Helpers\CompiledRouteCollection');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        try {
            cache()->forget('coursesCount');


            User::observe(UserObserver::class);
            Category::observe(CategoryObserver::class);
            AcademicLevel::observe(AcademicLevelObserver::class);
            Country::observe(CountryObserver::class);
            Course::observe(CourseObserver::class);

            $main      = cache()->remember('main-categories',60*60*24,function (){
                return Category::where('parent_id', null)->get();
            });

            $countries = cache()->remember('countries',60*60*24, function () {
                return Country::get();
            });
            $categories= cache()->remember('categories',60*60*24, function () {
                return Category::get();
            });
            $coursesCount= cache()->remember('coursesCount',60*60*24, function () {
                return Course::count();
            });
            $academics = cache()->remember('academics',60*60*24, function () {
                return AcademicLevel::get();
            });

            $nationalities = cache()->remember('nationalities',60*60*24, function () {
                return Nationality::get();
            });


            view()->share(['countries' => $countries,'nationalities' => $nationalities, 'main' => $main, 'coursesCount' => $coursesCount, 'mainCategories' => $main, 'academics' => $academics, 'categories' => $categories]);

            app()->bind('paginate', function () {
                return 5;
            });
        } catch (\Exception $e) {

       };



        app()->singleton('language', function (){
            if ( session() -> has( 'language' ) )
                return session( 'language' );
            else
                session()->put('language','ar');
                return 'ar';
        });


        $this->publishes([
            __DIR__ . '/../../vendor/almasaeed2010/adminlte/plugins' => public_path('admin'),
        ], 'public');

    }
}
