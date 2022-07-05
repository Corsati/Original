<?php

/*
 * This file is part of Laravel HTMLMin.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 * (c) Raza Mehdi <srmk@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Automatic Blade Optimizations
    |--------------------------------------------------------------------------
    |
    | This option enables minification of the blade views as they are
    | compiled. These optimizations have little impact on php processing time
    | as the optimizations are only applied once and are cached. This package
    | will do nothing by default to allow it to be used without minifying
    | pages automatically.
    |
    | Default: false
    |
    */

    'blade' => false,

    /*
    |--------------------------------------------------------------------------
    | Force Blade Optimizations
    |--------------------------------------------------------------------------
    |
    | This option forces blade minification on views where there such
    | minification may be dangerous. This should only be used if you are fully
    | aware of the potential issues this may cause. Obviously, this setting is
    | dependent on blade minification actually being enabled.
    |
    | PLEASE USE WITH CAUTION
    |
    | Default: false
    |
    */

    'force' => false,

    /*
    |--------------------------------------------------------------------------
    | Ignore Blade Files
    |--------------------------------------------------------------------------
    |
    | Here you can specify paths, which you don't want to minify.
    |
    */

    'ignore' => [
        'resources/views/emails',
        'resources/views/html',
        'resources/views/notifications',
        'resources/views/markdown',
        'resources/views/vendor/emails',
        'resources/views/vendor/html',
        'resources/views/vendor/notifications',
        'resources/views/vendor/markdown',
        'resources/views/website/components/javascript',
        'resources/views/website/js/chatDetails',
        'resources/views/website/js/settings',
        'resources/views/website/js/storeteachQualifications',
        'resources/views/website/js/teachQualifications',
        'resources/views/website/js/cart',
        'resources/views/website/js/category',
        'resources/views/website/js/subCategory',
        'resources/views/website/js/subSubCategory',
        'resources/views/website/js/create-course',
        'resources/views/website/js/course',
        'resources/views/website/js/courses',
        'resources/views/website/js/createStepThree',
        'resources/views/website/js/myCourse',
        'resources/views/website/js/myCourses',
        'resources/views/website/js/createStepTwo',
        'resources/views/website/js/searchResults',
    ],

];