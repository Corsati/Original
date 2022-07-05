<?php
use App\Models\User;
use Carbon\Carbon;

function Home() {

    $colors = ['#00C0EF','#4682B4','#1E90FF','#4682B4'];
//    $icons  = ['icon-pencil primary font-large-2 float-right','icon-wallet success font-large-2','icon-heart danger font-large-2','icon-speech warning font-large-2 mr-2','icon-pencil primary font-large-2 mr-2','icon-direction danger font-large-2 float-right','icon-cup success font-large-2 float-right','icon-bubbles warning font-large-2 float-right'];
    $home = [

        [
            'name'  => __('admins'),
            'count' => \App\Models\Admin::where('role_id', '>', '0')->count(),
            'icon'  => 'nav-icon fa fa-address-book',
            'color' => $colors[array_rand($colors)],
            'url'   => 'admin/admins'
        ],
        [
            'name'  => __('students'),
            'count' => User::where('user_type',2)->count(),
            'icon'  => 'fa fa-graduation-cap',
            'color' => $colors[array_rand($colors)],
            'url'   => 'admin/admins/users'
        ],
        [
            'name'  => __('instructors'),
            'count' => User::where('user_type',3)->count(),
            'icon'  => 'nav-icon fa fa-chalkboard-teacher' ,
            'color' => $colors[array_rand($colors)],
            'url'   => 'admin/admins/instructors'
        ],
        [
            'name'  => __('countries'),
            'count' => \App\Models\Country::count(),
            'icon'  => 'nav-icon fa fa-globe',
            'color' => $colors[array_rand($colors)],
            'url'   => 'admin/admins/countries'
        ],
        [
            'name'  => __('cities'),
            'count' => \App\Models\City::count(),
            'icon'  => 'nav-icon fa fa-map-marked',
            'color' => $colors[array_rand($colors)],
            'url'   => 'admin/admins/cities'
        ],
        [
            'name'  => __('categories'),
            'count' => \App\Models\Category::count(),
            'icon'  => 'nav-icon fa fa-th-list',
            'color' => $colors[array_rand($colors)],
            'url'   => 'admin/admins/categories'
        ],
        [
            'name'  => __('courses'),
            'count' => \App\Models\Course::count(),
            'icon'  => 'nav-icon fa fa-play-circle',
            'color' => $colors[array_rand($colors)],
            'url'   => 'admin/courses/active'
        ],
        [
            'name'  => __('messages'),
            'count' => \App\Models\ContactUs::count(),
            'icon'  => 'fa fa-comment',
            'color' => $colors[array_rand($colors)],
            'url'   => 'admin/contact_us'
        ],
    ];

    return $blocks[] = $home;
}
