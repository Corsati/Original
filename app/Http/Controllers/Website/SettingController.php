<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\User\ContactUs;
use App\Repositories\Interfaces\IContactType;
use App\Repositories\Interfaces\ISetting;
use App\Repositories\Interfaces\IUser;
use App\Repositories\Interfaces\ICity;
use App\Http\Requests\Website\Setting\City;
use App\Repositories\Interfaces\IContactUs;
use App;

class SettingController extends Controller
{
    protected $settingRepo, $userRepo, $contactTypeRepo , $contactUsRepo;

    public function __construct(ISetting $setting,IUser $user, IContactType $contactType, ICity $city , IContactUs $contact)
    {
        $this->settingRepo     = $setting;
        $this->userRepo        = $user;
        $this->contactTypeRepo = $contactType;
        $this->city            = $city;
        $this->contactUsRepo   = $contact;

    }


    public function language(){

        if(app()->language == 'ar')
        {
            app()->singleton('language', function (){
                session()->put('language','en');
                return 'en';
            });
        }else{
            app()->singleton('language', function (){
                session()->put('language','ar');
                return 'ar';
            });
        }


        return redirect()->back();
    }
    /***************************  get all settings  **************************/
    public function about(){
        $data          = $this->settingRepo->getAppInformation();
        return view('website.site.footerDetails.aboutUs',compact('data'));
    }

    public function help(){
        $data          = $this->settingRepo->getAppInformation();
        return view('website.site.footerDetails.help',compact('data'));
    }

    public function term(){
        $data          = $this->settingRepo->getAppInformation();
        return view('website.site.footerDetails.term',compact('data'));
    }

    public function policy(){
        $data          = $this->settingRepo->getAppInformation();
        return view('website.site.footerDetails.privacy-policy',compact('data'));
    }

    public function cookie(){
        $data          = $this->settingRepo->getAppInformation();
        return view('website.site.footerDetails.cookie-policy',compact('data'));
    }

    /***************************  ContactUs settings  **************************/
    public function contactUs(){
        $contactTypes  = $this->contactTypeRepo->get();
        $data          = $this->settingRepo->getAppInformation();
        return view('website.site.footerDetails.contactUs',compact('data','contactTypes'));
    }

    public function contactUsSend(ContactUs $request){
         $data         = array_filter($request->validated());
         $this->contactUsRepo->store($data);
        return response()->json(['url'=> route('coursati.index')]);
    }

    /***************************  Advertise settings  **************************/
    public function advertise(){
        $contactTypes  = $this->contactTypeRepo->get();
        $data          = $this->settingRepo->getAppInformation();
        return view('website.site.footerDetails.advertise',compact('data','contactTypes'));
    }
    /***************************   cities  **************************/
    public function getCities(City  $request){
        $cities        = $this->city->getByCountryId($request['country_id']);
        $html          = view('website.components.cities', compact('cities'))->render();
        return response()->json($html);
    }
}
