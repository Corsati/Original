<?php
namespace  App\Services;

class SettingService {

    public static function appInformations($app_info)
    {

        $data                               = [
            'name_ar'                       =>$app_info['name_ar'],
            'name_en'                       =>$app_info['name_en'],
            'latitude'                      =>$app_info['latitude'],
            'longitude'                     =>$app_info['longitude'],
            'twitter'                       =>$app_info['twitter'],
            'youtube'                       =>$app_info['youtube'],
            'instgram'                      =>$app_info['instgram'],
            'linkedin'                      =>$app_info['linkedin'],
            'facebook'                      =>$app_info['facebook'],
            'dribble'                       =>$app_info['dribble'],
            'behince'                       =>$app_info['behince'],
            'policy_ar'                     =>$app_info['policy_ar'],
            'policy_en'                     =>$app_info['policy_en'],
            'terms_ar'                      =>$app_info['terms_ar'],
            'terms_en'                      =>$app_info['terms_en'],
            'cookie_policy_ar'              =>$app_info['cookie_policy_ar'],
            'cookie_policy_en'              =>$app_info['cookie_policy_en'],
            'about_ar'                      =>$app_info['about_ar'],
            'about_en'                      =>$app_info['about_en'],
            'help_ar'                       =>$app_info['help_ar'],
            'help_en'                       =>$app_info['help_en'],
            'title_en'                       =>$app_info['title_en'],
            'title_ar'                       =>$app_info['title_ar'],
            'description_en'                       =>$app_info['description_en'],
            'description_ar'                       =>$app_info['description_ar'],
        ];
        return $data;
    }



}
