<?php

namespace App\Providers;

use App\Models\Favourite;
use App\Models\FinishedLecture;
use App\Repositories\Eloquent\AcademicRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\CategoryUserRepository;
use App\Repositories\Eloquent\CityRepository;
use App\Repositories\Eloquent\ContactUsRepository;
use App\Repositories\Eloquent\CourseBenefitRepository;
use App\Repositories\Eloquent\CourseCertificateRepository;
use App\Repositories\Eloquent\CourseLectureFileRepository;
use App\Repositories\Eloquent\CourseLectureRepository;
use App\Repositories\Eloquent\CourseLectureTestRepository;
use App\Repositories\Eloquent\CourseRepository;
use App\Repositories\Eloquent\CourseRequirementRepository;
use App\Repositories\Eloquent\DurationRepository;
use App\Repositories\Eloquent\FinishedLectureRepository;
use App\Repositories\Eloquent\NationalityRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\PriceTireRepository;
use App\Repositories\Eloquent\QualificationRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\SettingRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\CountryRepository;
use App\Repositories\Eloquent\TeachingCategoryRepository;
use App\Repositories\Eloquent\TagRepository;
use App\Repositories\Eloquent\BannerRepository;
use App\Repositories\Eloquent\ContactTypeRepository;
use App\Repositories\Eloquent\CourseContentRepository;
use App\Repositories\Eloquent\FavouriteRepository;
use App\Repositories\Eloquent\OfferRepository;
use App\Repositories\Eloquent\CartRepository;
use App\Repositories\Interfaces\IAcademic;
use App\Repositories\Interfaces\IFinishedLecture;
use App\Repositories\Interfaces\IBanner;
use App\Repositories\Interfaces\ICourseContent;
use App\Repositories\Interfaces\IDuration;
use App\Repositories\Interfaces\IFavourite;
use App\Repositories\Interfaces\IOffer;
use App\Repositories\Interfaces\IContactType;
use App\Repositories\Interfaces\IPriceTire;
use App\Repositories\Interfaces\IRole;
use App\Repositories\Interfaces\IUser;
use App\Repositories\Interfaces\ICity;
use App\Repositories\Interfaces\ICountry;
use App\Repositories\Interfaces\ITag;
use App\Repositories\Interfaces\ICategory;
use App\Repositories\Interfaces\INationality;
use App\Repositories\Interfaces\ITeachingCategory;
use App\Repositories\Interfaces\ICourseRequirement;
use App\Repositories\Interfaces\ICourse;
use App\Repositories\Interfaces\ICourseLecture;
use App\Repositories\Interfaces\ICourseLectureFile;
use App\Repositories\Interfaces\ICourseLectureTest;
use App\Repositories\Interfaces\IQualification;
use App\Repositories\Interfaces\ICourseBenefit;
use App\Repositories\Interfaces\ICourseCertificate;
use App\Repositories\Interfaces\IContactUs;
use App\Repositories\Interfaces\ICategoryUser;
use App\Repositories\Interfaces\ISetting;
use App\Repositories\Interfaces\IOrder;
use App\Repositories\Interfaces\ICart;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ICategoryUser::class      , CategoryUserRepository::class);
        $this->app->bind(IContactType::class       , ContactTypeRepository::class);
        $this->app->bind(IAcademic::class          , AcademicRepository::class);
        $this->app->bind(IRole::class              , RoleRepository::class);
        $this->app->bind(IUser::class              , UserRepository::class);
        $this->app->bind(ICity::class              , CityRepository::class);
        $this->app->bind(ICountry::class           , CountryRepository::class);
        $this->app->bind(ICategory::class          , CategoryRepository::class);
        $this->app->bind(ITag::class               , TagRepository::class);
        $this->app->bind(INationality::class       , NationalityRepository::class);
        $this->app->bind(ICourse::class            , CourseRepository::class);
        $this->app->bind(IQualification::class     , QualificationRepository::class);
        $this->app->bind(ITeachingCategory::class  , TeachingCategoryRepository::class);
        $this->app->bind(ICourseRequirement::class , CourseRequirementRepository::class);
        $this->app->bind(ICourseLecture::class     , CourseLectureRepository::class);
        $this->app->bind(ICourseLectureTest::class , CourseLectureTestRepository::class);
        $this->app->bind(ICourseBenefit::class     , CourseBenefitRepository::class);
        $this->app->bind(ICourseContent::class     , CourseContentRepository::class);
        $this->app->bind(ICourseCertificate::class , CourseCertificateRepository::class);
        $this->app->bind(IBanner::class            , BannerRepository::class);
        $this->app->bind(IContactUs::class         , ContactUsRepository::class);
        $this->app->bind(IOffer::class             , OfferRepository::class);
        $this->app->bind(ISetting::class           , SettingRepository::class);
        $this->app->bind(ICourseLectureFile::class , CourseLectureFileRepository::class);
        $this->app->bind(IOrder::class             , OrderRepository::class);
        $this->app->bind(IFavourite::class         , FavouriteRepository::class);
        $this->app->bind(ICart::class              , CartRepository::class);
        $this->app->bind(IPriceTire::class         , PriceTireRepository::class);
        $this->app->bind(IDuration::class          , DurationRepository::class);
        $this->app->bind(IFinishedLecture::class   , FinishedLectureRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
