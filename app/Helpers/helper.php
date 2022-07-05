<?php

use App\Models\Favourite;
use App\Models\User;
use App\Models\Permission;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Route;

function updateRole($id)
{
    //get all routes
    $routes = Route::getRoutes();
    $permissions = Permission::where('role_id', $id)->pluck('permission')->toArray();

    $m = null;
    foreach ($routes as $value) {
        if ($value->getName() !== null) {

            //display main routes
            if (isset($value->getAction()['type']) && $value->getAction()['type'] == 'parent' &&
                isset($value->getAction()['icon']) && $value->getAction()['icon'] != null) {

                echo '<div class = "col-xs-3">';
                echo '<div class = "per-box">';


                // main route
                echo ' <label>';
                echo '<input type = "checkbox" name = "permissions[]"';

                if (in_array($value->getName(), $permissions))
                    echo ' checked';

                echo '  value="' . $value->getName()
                    . '">';
                echo ' <span class = "checkmark"></span>';
                echo '<span class = "name">' . $value->getAction()["title"] . '</span>';
                echo '</label>';
                //sub routes
                if (isset($value->getAction()["child"])) {

                    $childs = $value->getAction()["child"];
                    $r2 = Route::getRoutes();

                    foreach ($r2 as $r) {
                        if ($r->getName() !== null && in_array($r->getName(), $childs)) {

                            echo ' <label>';
                            echo '<input type = "checkbox" name = "permissions[]"';

                            if (in_array($r->getName(), $permissions))
                                echo ' checked ';

                            echo ' value="' . $r->getName() . '">';
                            echo ' <span class = "checkmark"></span>';
                            echo '<span class = "name">' . $r->getAction()["title"] . '</span>';
                            echo '</label>';
                        }
                    }
                }
                echo ' </div>';
                echo '</div>';

            }
        }
    }
}

function Translate($text, $lang)
{
    $api = 'trnsl.1.1.20201101T180227Z.875886c0b7db970c.7c2bd36a60d8c03bbaa408f56c5a058f73059da2';
    $url = file_get_contents('https://translate.yandex.net/api/v1.5/tr.json/translate?key=' . $api
        . '&lang=ar' . '-' . $lang . '&text=' . urlencode($text));
    $json = json_decode($url);
    return $json->text[0];
}

function lang()
{
    return App()->getLocale();
}

function filter_request_keys($request)
{
    foreach ($request as $key => $value) {
        if (is_null($value) || $value == '')
            unset($request[$key]);
    }
    return $request;
}

function status_text($status)
{
    if ($status == 'pending') {
        return __('is_pending');
    } elseif ($status == 'Arabic') {
        return __('ar');
    }
}

function level_text($status)
{
    if ($status == 'mid_level') {
        return __('Mid');
    } elseif ($status == 'junior_level') {
        return __('Junior');
    } else {
        return __('Advanced');
    }
}


function createRandomUuid()
{
    $partOne = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);
    $partTwo = substr(str_shuffle("0123456789"), 0, 4);
    return $partOne . $partTwo;
}


function setUrl($path, $name)
{
    if ($_SERVER['REMOTE_ADDR'] !== '127.0.0.1')
        return url('public/' . $path . $name);
    else
        return url($path . $name);
}

function setAsset($path)
{

    if ($_SERVER['REMOTE_ADDR'] !== '127.0.0.1')
        return url('public/' . $path);
    if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1')
        return url('' . $path);
    else
        return url($path);
}

function seoUrl($string)
{

    return $text = str_replace(" ", "-", $string);;

    $text = strtolower(htmlentities($string));
    $text = str_replace(get_html_translation_table(), "-", $text);
    $text = str_replace(" ", "-", $text);
    $text = preg_replace("/[-]+/i", "-", $text);
    return $text;
}

function navigateToCourse($course)
{
    if ($course->steps == 'one') {
        if (is_null($course->image) || is_null($course->promotional_video) || is_null($course->description) || is_null($course->price) || is_null($course->level) || is_null($course->total_hours) || count($course->requirements) == 0) {
            return url('create-course/' . $course->category_id . '/edit/' . $course->id . '');;

        } else {
            return url('create-step-two/' . $course->id);
        }
    } elseif ($course->steps == 'two') {
        return url('create-step-three/' . $course->id);
    }
}

function str_random($length = 20){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function courseProgress($course)
{
    if($course->steps == 'one')
    {
        return 33.33;
    }elseif ($course->steps == 'two')
    {
        return 66.33;
    }elseif ($course->steps == 'three')
    {
        return 100;
    }else{
        return  0;
    }
}

function courseStatus($course)
{
    $course = \App\Models\Course::find($course->course_id);
    $lectures = $course->lectures->pluck('id');
    $filesCount = \App\Models\CourseLectureFile::whereIn('course_lecture_id', $lectures)->pluck('id');
    $finished = \App\Models\FinishedLecture::whereIn('course_lecture_file_id', $filesCount)->where('user_id', auth()->id())->where('completed', 1)->count();
    $count = count($filesCount) == 0 ? 1 : count($filesCount);
    return ($finished / $count) * 100;
}
function course_progress($id)
{
    $course = \App\Models\Course::find($id);
    $lectures = $course->lectures->pluck('id');
    $filesCount = \App\Models\CourseLectureFile::whereIn('course_lecture_id', $lectures)->pluck('id');
    $finished = \App\Models\FinishedLecture::whereIn('course_lecture_file_id', $filesCount)->where('user_id', auth()->id())->where('completed', 1)->count();
    $count = count($filesCount) == 0 ? 1 : count($filesCount);
    return ($finished / $count) * 100;
}

function discountCourse($price, $discount)
{
    return $price - ($discount / 100) * $price;
}

function convertNumbers($str)
{
//    $western_arabic = array('0','1','2','3','4','5','6','7','8','9');
//    $eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
//    $str = str_replace($western_arabic, $eastern_arabic, $str);
    return $str;
}

function make_slug($title, $separator = '-')
{
    $seo_st = str_replace(' ', '-', $title);
    $seo_alm = str_replace('--', '-', $seo_st);
    $title_seo = str_replace(' ', '', $seo_alm);
    return mb_strtolower($title_seo, 'UTF-8');
}

function isFavourite($id)
{
    return Favourite::where('user_id', auth()->id())->where('course_id', $id)->first();
}

function isCart($id)
{
    return \App\Models\Carts::where('user_id', auth()->id())->where('course_id', $id)->first();
}

function instructorRate($user)
{
    $courses = $user->courses->pluck('id');
    $ratings = \App\Models\Comment::whereIn('course_id', $courses)->get();
    $ratingValues = [];

    foreach ($ratings as $aRating) {
        $ratingValues[] = $aRating->rate;
    }

    if ($ratings->count() > 0) {
        return collect($ratingValues)->sum() / $ratings->count();
    }

    return 0;
}

function getVideoId($file)
{
    parse_str(parse_url($file, PHP_URL_QUERY), $my_array_of_vars);
    // dd(isset($my_array_of_vars['v']) ? $my_array_of_vars['v'] :null);
    return isset($my_array_of_vars['v']) ? $my_array_of_vars['v'] : null;
}

function getVideoTime($videoId)
{
    $dur = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=$videoId&key=AIzaSyAZ95QK9PCxYqMQ-KBKXoD8ZV3Ow3mkh4s");
    $duration = json_decode($dur, true);
    foreach ($duration['items'] as $vidTime) {
        $vTime = $vidTime['contentDetails']['duration'];
    }
    return covtime($vTime);
}

function covtime($youtube_time)
{
    preg_match_all('/(\d+)/', $youtube_time, $parts);

// Put in zeros if we have less than 3 numbers.
    if (count($parts[0]) == 1) {
        array_unshift($parts[0], "0", "0");
    } elseif (count($parts[0]) == 2) {
        array_unshift($parts[0], "0");
    }

    $sec_init = $parts[0][2];
    $seconds = $sec_init % 60;
    $seconds_overflow = floor($sec_init / 60);

    $min_init = $parts[0][1] + $seconds_overflow;
    $minutes = ($min_init) % 60;
    $minutes_overflow = floor(($min_init) / 60);

    $hours = $parts[0][0] + $minutes_overflow;
    if ($hours != 0)
        return $hours . ':' . $minutes . ':' . $seconds;
    else
        return $minutes . ':' . $seconds;
}

function checkIfCompleted($id)
{
    $file = \App\Models\FinishedLecture::where('course_lecture_file_id', $id)->where('user_id', auth()->id())->first();
    if ($file) {
        if ($file->completed === 1) {
            return ['status' => __('web.Finished'), 'color' => '#F00'];
        } else {
            return ['status' => __('web.Progress'), 'color' => '#3ae16d'];

        }
    }
    return ['status' => __('web.Waiting'), 'color' => '#ff7600'];
}

function IfCompleted($id)
{
    $file = \App\Models\FinishedLecture::where('course_lecture_file_id', $id)->where('user_id', auth()->id())->first();
    if ($file) {
        if ($file->completed == 1) {
            return true;
        } else {
            return false;
        }
    }else{
        return false;
    }
}


function findCourseName($id)
{
    return \App\Models\Course::findOrFail($id)->title;
}

function sendNotification($attributes,$user)
{

    $details           = [
        'subject'      => $attributes['subject'],
        'greeting'     => $attributes['greeting'],
        'body'         => $attributes['body'],
        'thanks'       => __('web.thanksToUse'),
        'actionText'   =>__('web.visitUs'),
        'actionURL'    => url('/'),
        'course_id'    => $attributes['course_id'] ?? null,
        'room_id'      => $attributes['room_id'] ?? null,
        'type'         => $attributes['type'],
    ];

    Notification::send($user, new SystemNotification($details));
    sendPush($user,$attributes['subject'],$attributes['body']);
}

function sendPush($user , $title , $body)
{
    $user            = User::find($user->id);

    if($user)
    {
        $SERVER_API_KEY = 'AAAAPHTlBRI:APA91bEWMT-EI5STLhOdijbsnt5oUUjmKpBzkWESt43cc_3wXOQR7nVKkv4A_Q74yAY2nkH_C809ER1GmzMn_8zCoHHGjlvYe84832VaAxliJUv1g1t7YLlgociGbX9nkguuFovXbRyp';
        $data        = [
            "to" => $user->device_token,
            "notification" => [
                "title"    => $title,
                "body"     => $body,
            ]
        ];
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch     = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
    }
}

function courseLng($course){
    return $course->language;
}


function encode_fullurl($url) {
    $output = '';
    $valid  = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.~!*\'();:@&=+$,/?#[]%';
    $length = strlen($url);
    for ($i = 0; $i < $length; $i++) {
        $character = $url[$i];
        $output   .= (strpos($valid, $character) === false ? rawurlencode($character) : $character);
    }
    return $output;
}
