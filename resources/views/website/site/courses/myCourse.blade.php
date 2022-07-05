@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <style>
        .myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .myImg:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)}
            to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            z-index : 999;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }

        .myCourse .courseVedio .vedioCont .controllers .dropCont .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn), .myCourse .courseVedio .vedioCont .controllers .dropCont .bootstrap-select > .dropdown-toggle{
            width: 50px !important;
        }
        .fake-input img {
            position: absolute;
            top: -10px;
            left: 25%;
            display: none;
            border-radius: 5px;
        }
        .courseContent{
        }
        .image-upload>input {
            display: none;
        }
        @media screen and (max-width: 600px) {
            #speed {
                visibility: hidden;
                clear: both;
                float: left;
                margin: 0;
                height: 0;
                display: none;
            }
        }
        .startsBlock{
            font-size: 12px!important;
        }
        body .myCourse .courseVedio .vedioCont{
            margin-bottom: 0!important;
        }
        .myCourse .courseVedio .courseContent{
           height: auto !important;
        }
        .progress-bar{
            height: 5px;
            margin: 5px;
        }
    </style>

    <!--start light gray bg-->
    <div class="lightGrayBg pb-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href=""><i class='fas fa-chevron-left'></i>{{$course->category->getTranslation('name',$course->language)}}</a></li>
                    @if($course->category)
                        @if($course->category->parent)
                        <li class="breadcrumb-item active" aria-current="page">{{$course->category->parent->getTranslation('name',$course->language) }}</li>
                        @endif
                    @endif
                </ol>
            </nav>
        </div>
    </div>

    <div class="whiteBg myCourse">
        <div class="container">
            <div class="courseInfo">
                <div class="courseText d-flex justify-content-between align-items-center w-100">
                    <div class="leftDiv">
                        <p>{{$course->getTranslation('title',courseLng($course))}}</p>
                        <p>{{$course->user->first_name}} {{$course->user->last_name}}</p>
                        <p class="desc">
                            {{ \Illuminate\Support\Str::limit($course->getTranslation('description',courseLng($course)), 150, $end='...') }}
                        </p>
                    </div>
                    <div class="rightDiv">
                        <div class="btns d-flex align-items-center">
                            <a class="orangeBtn {{!is_null(isFavourite($course->id)) ? 'is-favourite' : 'favourites'}}" id="favourite"   style="margin-right: 10px;margin-left: 10px;"><i class="fas fa-heart"></i></a>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-start">
                            <div class="info d-flex flex-column justify-content-center">
                                <div><img src="{{setAsset('website/img/book.svg')}}" alt="calender"> {{count($course->lectures)}} {{__('web.Lecture')}}</div>
                                <div><img src="{{setAsset('website/img/time.svg')}}" alt="calender"> {{$course->duration->to}}    {{__('web.total-hours')}}</div>
                                <div><img src="{{setAsset('website/img/goal.svg')}}" alt="calender"> {{$course->level()->first()->name}}</div>
                            </div>
                            <div class=" startsBlock d-flex flex-row align-items-center">
                                <div class="stars">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $course->comments->avg('rate'))
                                            <i class="fas fa-star"></i>
                                        @else
                                            <span class="fas fa-star"></span>
                                        @endif
                                    @endfor
                                </div>
                                <span><span>{{round($course->comments->avg('rate'),2)}}</span>({{$course->comments->count()}})</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="customHr boldHr">
        <div class="container">
            <div class="courseVedio plyr__video-embed">
                <div class="vedioCont">
                    <div style="height: 80%" id="player">
                    <iframe width="560" height="315" style="height: 100%" src="https://www.youtube.com/embed/YP2f-ErXG_M" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                   <div >
                        <div class="vedioCont" style="width: 100%">
                            <div class="controllers">
                                <a class="togglePlay" id="player-container">
                                    <i class="fas fa-pause"></i>
                                </a>
                                <div class="duration" ><span id="current-time"></span> / <span id="duration"></span></div>
                                <div class="volumeCont">
                                    <a class="setVolume mute-toggle"  id="mute-toggle">
                                        <i class="fas fa-volume-up mute-toggle"></i>
                                    </a>
                                    <input class="range-slider__range" style="width: 100%;color: orange" type="range"    value="0" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" >
                                </div>

                                <div class="dropCont" id="speed">
                                    <span>speed</span>
                                    <select class="selectpicker" id="speed" >
                                        <option value="0.25">0.25</option>
                                        <option value="0.5">0.5</option>
                                        <option value="1" selected="selected">1</option>
                                        <option value="1.5">1.5</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>

                                <div class="dropCont">
                                    <a id="play-fullscreen"><li class="fas fa-expand"></li></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="courseContent" style="overflow-y: auto;" >
                    <div id="accordion" class="myaccordion"  >
                        @foreach($course->lectures as $lecture)
                            <div class="card">
                                <div class="card-header" id="headingOne {{$lecture->id}}">
                                    <h2 class="mb-0">
                                        <button class="w-100 d-flex align-items-center justify-content-between btn btn-link "
                                                data-toggle="collapse" data-target="#collapseOne{{$lecture->id}}" aria-expanded="true"
                                                aria-controls="collapseOne{{$lecture->id}}">

                                            <div class="headTitle d-flex align-items-center" style=" font-weight: bold !important;font-size: 16px">
                                            <span>
                                                <i class="fas fa-minus"></i>
                                            </span>
                                                {{$lecture->getTranslation('name',$course->language)}}
                                            </div>


                                            <div class="headInfo d-flex align-items-center">
                                                <span>{{__(convertNumbers(count($lecture->lectureFiles)))}} {{__('web.Lectures')}}</span>
                                            </div>
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseOne{{$lecture->id}}" class="collapse show" aria-labelledby="headingOne{{$lecture->id}}"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <ul>
                                            @foreach($lecture->lectureFiles as $file)
                                                <li class="lightGrayBg">
                                                    <i class="fas fa-play-circle click" data-id="{{$file->video_id}}" style="padding: 8px;margin: 8px;color: #ff7600;font-size: 22px;"></i>
                                                    <div class="w-100">
                                                        <div style="display: flex; justify-content: space-between;">
                                                            <p style="font-size: 14px"> - {{$file->getTranslation('name',$course->language)}}</p>

                                                            <span style="text-align: right;float: right;color: {{checkIfCompleted($file->id)['color']}}" id="status-{{$file->video_id}}" >{{checkIfCompleted($file->id)['status']}}</span>
                                                        </div>
                                                        <div >
                                                            <input class="progress-bar orangeBg progressRange " style="width: 100%;color: orange" type="range" data-id="{{$file->video_id}}" id="progress{{$file->video_id}}" value="{{IfCompleted($file->id) ?'100':'0'}}" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" >
                                                        </div>
                                                        <div >
                                                            <span class="timer">{{$file->video_time}}</span>
                                                        </div>
                                                    </div>
                                                </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end course Info bg-->
    <div class="lightGrayBg pb-5">
        <div class="container">
            <div class="courseContent  mt-0" style="overflow-y: unset;
">
                <div class="courseTabs">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link" id="nav-Description-tab" data-toggle="tab" href="#nav-Description" role="tab" aria-controls="nav-Description" aria-selected="true">{{__('web.Description')}}</a>
                            <a class="nav-link {{round(course_progress($course->id)) != '100' ? 'active' : ''}}" id="nav-qA-tab" data-toggle="tab" href="#nav-qA" role="tab" aria-controls="nav-qA" aria-selected="false">{{__('web.Q_A')}}</a>
                            <a class="nav-link" id="nav-learn-tab" data-toggle="tab" href="#nav-learn" role="tab" aria-controls="nav-learn" aria-selected="false">{{__('web.In this course you’ll')}}</a>
                            <a class="nav-link" id="nav-Requirements-tab" data-toggle="tab" href="#nav-Requirements" role="tab" aria-controls="nav-Requirements" aria-selected="false">{{__('web.Requirements')}}</a>
                            <a class="nav-link {{round(course_progress($course->id)) == '100' ? 'active' : ''}}" id="nav-Certificate-tab" data-toggle="tab" href="#nav-Certificate" role="tab" aria-controls="nav-Certificate" aria-selected="false">{{__('web.Certificate task')}}</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade" id="nav-Description" role="tabpanel" aria-labelledby="nav-Description-tab">
                            {{__('web.Description')}}
                            <p class="desc" style="    word-break: break-all;">
                                {{ \Illuminate\Support\Str::limit($course->getTranslation('description',courseLng($course)), 150, $end='...') }}
                            </p>
                        </div>
                        <div class="tab-pane fade  {{round(course_progress($course->id)) != '100' ? 'show active' : ''}}" id="nav-qA" role="tabpanel" aria-labelledby="nav-qA-tab">
                            <h3 class="title">{{__('web.Chat With Teacher')}}</h3>

                             <!-- <p style="text-align: center;color: #F00;line-height: 2em">
                                بعد التآكد من استكمال جميع المحاضرات قم بتحميل الإختبارات من خانة إختبارات وشهادات
                                و بعد ان تقوم بحل الاختبار قم بإعادة إرساله للمدرب بالمحادثة والضغط علي زر طلب استخراج الشهاده
                                وسوف يتواصل معك المدرب
                            </p>
                            -->

                            <div class="chatContainer">
                                <div class="chatHead">
                                    <img src="{{$course->user->avatar}}" class="align-self-center mr-3" alt="profile">
                                    <span>{{$course->user->first_name}} {{$course->user->last_name}}</span>
                                    <!--@if(round(course_progress($course->id)) == '100')
                                    <button class="btn btn-outline-info float-left">لقد قمت بإنهاء الاختبار وارغب باستخراج شهادة </button>
                                    @endif
                                    -->
                                </div>
                                <div class="chatBox" id="chatBox">
                                    @foreach($conversations as $conversation)
                                        <div class="{{$conversation->s_id == auth()->id() ? 'rightCont' : 'leftCont' }}">
                                            <div class="rightText">
                                              @if($conversation->type == 'text')
                                                    {{$conversation->message}}
                                                @elseif($conversation->type == 'image')
                                                    <img height="100" width="110" class="myImg" src="{{setUrl('storage/images/chat/',$conversation->message)}}">
                                                @elseif($conversation->type == 'video')
                                                    <video width="320" height="240" controls>
                                                        <source src="{{setUrl('storage/images/chat/',$conversation->message)}}" type="video/mp4">
                                                        <source src="{{setUrl('storage/images/chat/',$conversation->message)}}" type="video/ogg">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @else
                                                    <a href="{{setUrl('storage/images/chat/',$conversation->message)}}" target="_blank">
                                                        <img height="100" width="110"   src="{{setAsset('website/img/file.png')}}">
                                                    </a>                                               @endif
                                            </div>
                                            <div class="time">
                                                <i class="fas fa-check-double"></i>
                                                {{$conversation->created_at->diffForHumans()}}
                                            </div>
                                        </div>
                                        @php
                                            $conversation->update(['seen' => 1])
                                        @endphp
                                    @endforeach
                                </div>
                                <div class="chatFooter">
                                    <form action="{{route('coursati.sendChatMessage')}}" class="ajaxSendMessage" method="post">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{$course->id}}">
                                        <div class="form-group fake-input ">
                                            <input  id="message" name="message" value="" type="text" class="form-control"   placeholder="{{__('web.Type here')}}">
                                            <img id="chatImageMessage" src="https://findicons.com/files/icons/2813/flat_jewels/512/file.png" width="70"/>

                                        </div>
                                        <button type="submit" id="send"   class="orangeBtn">{{__('web.send')}}</button>
                                        <div class="form-group paperClip">
                                            <input id="photo-upload" name="file" class="uploadFile"  type="file">
                                            <a class=""><i class="fas fa-paperclip"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-learn" role="tabpanel" aria-labelledby="nav-learn-tab">
                            <div class="courseLearn">
                                <h3 class="title">{{__('web.In this course you’ll')}}</h3>
                                <div class="learnUl w-100">
                                    <ul>
                                        @foreach($course->benefits as $benefit)
                                            <li>
                                                <span><img src="{{asset('website/img/tick.svg')}}" alt="tick"></span>
                                                <p>{{$benefit->getTranslation('name',$course->language)}}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-Requirements" role="tabpanel" aria-labelledby="nav-Requirements-tab">
                            <div class="courseLearn">
                                <h3 class="title">{{__('web.Requirements')}}</h3>
                                <div class="requirment w-100">
                                    <ul>
                                        @foreach($course->requirements as $requirement)
                                            <li>
                                                <span><img src="{{asset('website/img/info.svg')}}" alt="tick"></span>
                                                <p>{{$requirement->getTranslation('name',$course->language)}}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{round(course_progress($course->id)) == '100' ? 'show active' : ''}}" id="nav-Certificate" role="tabpanel" aria-labelledby="nav-Certificate-tab">
                            <div class="courseLearn">
{{--                                <h3 class="title">{{__('web.Certificates')}}</h3>--}}
                                <div class="requirment w-100">
{{--                                    <div>--}}
{{--                                        @foreach($course->certificates as $certificate)--}}
{{--                                            <div style="display: flex;justify-content: space-between; margin: 20px;border-bottom: 0.02px solid #bbb;border-radius: 5px;padding: 10px;">--}}
{{--                                                <!--<p>{{$certificate->getTranslation('title',$course->language)}}</p>-->--}}
{{--                                                <p style="" class="col-6">{{$certificate->getTranslation('details',$course->language)}}</p>--}}
{{--                                                    <a href="{{$certificate->file}}" style="color:#ff7600;" target="_blank" class="col-3 ">{{__('web.download')}}</a>--}}
{{--                                              <form novalidate class="d-flex justify-content-between align-items-center ajaxTaskSubmit" action="{{route('coursati.taskSubmit')}}"  enctype="multipart/form-data" method="POST">--}}
{{--                                                  @csrf--}}
{{--                                                  <input type="hidden" name="course_certificate_id" value="{{$certificate->id}}">--}}
{{--                                                  <input type="hidden" name="course_id" value="{{$course->id}}">--}}
{{--                                                  <div class="image-upload col-3" style="flex: 0 0 0;">--}}
{{--                                                      <label for="file-input" >--}}
{{--                                                          <i class="fas fa-upload  mt-3" style="font-size: 24px;"></i>--}}
{{--                                                      </label>--}}
{{--                                                      <input id="file-input"  type="file"  name="task" />--}}
{{--                                                  </div>--}}
{{--                                                  <button type="submit" class="btn btn-outline-info">{{__('web.upload')}}</button>--}}
{{--                                              </form>--}}
{{--                                            </div>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="customHr">
                <div class="card instructorCard">
                    <div class="media">
                        <img src="{{$course->user->avatar}}" class="align-self-center mr-3" alt="profile">
                        <div class="media-body">
                            <h5 class="mt-0">
                                <span>{{$course->user->first_name}} {{$course->user->last_name}}</span>
                                <div class="startsBlock d-flex flex-row align-items-center">
                                    <div class="stars">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < instructorRate($course->user))
                                                <i class="fas fa-star"></i>
                                            @else
                                                <span class="fas fa-star"></span>
                                            @endif
                                        @endfor
                                    </div>
                                    <span><span>{{round(instructorRate($course->user),2)}}</span></span>
                                </div>
                            </h5>
                            <p class="desc">{{$course->user->about}}</p>
                            <div class="info d-flex flex-row align-items-center mr-4">
                                <div><img src="{{asset('website/img/book.svg')}}" alt="calender"> {{count($course->lectures)}} {{__('web.Lectures')}}</div>
                                <div><img src="{{asset('website/img/time.svg')}}" alt="calender"> {{$course->duration->to}}   {{__('web.Hours')}}</div>
                                <div><img src="{{asset('website/img/goal.svg')}}" alt="calender"> {{$course->level()->first()->name}} </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="learnNext moreCourses popularInstructors flex-column align-items-start">
                    <h2 class="title">{{__('web.More courses by instructor')}}</h2>
                    <p class="desc">{{__('web.Course that')}}</p>
                    <div id="owl-demo7" class="owl-carousel">
                        @foreach($course->user->courses->where('steps','three')->where('status','active') as $tutorial)
                            <div class="item">
                                <a href="{{route('coursati.courseDetails',['id' => $tutorial->id , 'name' => make_slug($tutorial->name)])}}"  class="course">
                                    <div class="imgBlock">
                                        <img src="{{$tutorial->image}}" alt="course image">
                                    </div>
                                    <div class="p-3">
                                        <p class="courseName">{{$tutorial->title}}</p>
                                        <p class="instructorName">{{$tutorial->user->first_name}} {{$tutorial->user->last_name}}</p>
                                        <div class=" startsBlock d-flex flex-row align-items-center">
                                            <div class="stars">
                                                @for ($i = 0; $i < 5; $i++)
                                                    @if ($i < $tutorial->comments->avg('rate'))
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <span class="fas fa-star"></span>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span><span>{{round($tutorial->comments->avg('rate'),2)}}</span>({{$tutorial->comments->count()}})</span>
                                        </div>
                                        @if($tutorial->discount > 0)
                                            <div class="price"><sup>$</sup>{{discountCourse($tutorial->price , $tutorial->discount)}}<span><sup>$</sup>{{ ( float) $tutorial->price}}</span></div>
                                        @else
                                            <div class="price"><sup>$</sup>{{ ( float) $tutorial->price}}</span></div>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="studentsRating">
                    <div class="rates">
                        <div class="leftDiv">
                            <h3 class="title">{{__('web.Student_Rating')}}</h3>
                            <span>5.0</span>
                            <div class=" startsBlock d-flex flex-column align-items-center">
                                <div class="stars">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $course->comments->avg('rate'))
                                            <i class="fas fa-star"></i>
                                        @else
                                            <span class="fas fa-star"></span>
                                        @endif
                                    @endfor
                                </div>
                                <span><span>{{round($course->comments->avg('rate'),2)}}</span>({{$course->comments->count()}})</span>
                            </div>
                            <p>{{__('web.Course_rating')}}</p>
                        </div>
                        <div class="rightDiv">
                            <div class="d-flex flex-row align-items-center justify-content-between">
                                <div class="progress progWidth">
                                    @if ($course->comments->where('rate',5)->avg('rate')*10 == 50)
                                        <div class="progress-bar orangeBg" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    @else
                                        <span class="progress-bar"></span>
                                    @endif
                                </div>

                                <div class="startsBlock d-flex flex-row align-items-center" >
                                    <div class="stars">
                                        <span>5 {{__('web.Stars')}}</span>
                                        <span>({{$course->comments->where('rate',5)->count()}})</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center justify-content-between">
                                <div class="progress progWidth">
                                    @if ($course->comments->where('rate',4)->avg('rate')*10 == 40)
                                        <div class="progress-bar orangeBg" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    @else
                                        <span class="progress-bar"></span>
                                    @endif
                                </div>
                                <div class="startsBlock d-flex flex-row align-items-center" >
                                    <div class="stars">
                                        <span>4 {{__('web.Stars')}}</span>
                                        <span>({{$course->comments->where('rate',4)->count()}})</span>
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex flex-row align-items-center justify-content-between">
                                <div class="progress progWidth">
                                    @if ($course->comments->where('rate',3)->avg('rate')*10 == 30)
                                        <div class="progress-bar orangeBg" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    @else
                                        <span class="progress-bar"></span>
                                    @endif
                                </div>
                                <div class="startsBlock d-flex flex-row align-items-center" >
                                    <div class="stars">
                                        <span>3 {{__('web.Stars')}}</span>
                                        <span>({{$course->comments->where('rate',3)->count()}})</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center justify-content-between">
                                <div class="progress progWidth">
                                    @if ($course->comments->where('rate',2)->avg('rate')*10 == 20)
                                        <div class="progress-bar orangeBg" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    @else
                                        <span class="progress-bar"></span>
                                    @endif
                                </div>
                                <div class="startsBlock d-flex flex-row align-items-center" >
                                    <div class="stars">
                                        <span>2 {{__('web.Stars')}}</span>
                                        <span>({{$course->comments->where('rate',2)->count()}})</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-row align-items-center justify-content-between">
                                <div class="progress progWidth">
                                    @if ($course->comments->where('rate',1)->avg('rate')*10 == 10)
                                        <div class="progress-bar orangeBg" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="10" aria-valuemax="100"></div>
                                    @else
                                        <span class="progress-bar"></span>
                                    @endif
                                </div>
                                <div class="startsBlock d-flex flex-row align-items-center" >
                                    <div class="stars">
                                        <span>1 {{__('web.Stars')}}</span>
                                        <span>({{$course->comments->where('rate',1)->count()}})</span>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <hr class="customHr">

                <div class="myFeedBack">
                    <form action="{{route('coursati.comment')}}" method="post" class="ajaxCommentSubmit" id="addStar">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="title mt-0">{{__('web.My_feedback')}}</h3>
                              <div class="startsBlock d-flex flex-row align-items-center">
                                <div class="rating-box">
                                     <div class="rating-container" >
                                        <input class="myRate" type="radio" name="rate" value="5" id="star-5"> <label for="star-5"><i class="fas fa-star"></i></label>
                                        <input class="myRate" type="radio" name="rate" value="4" id="star-4"> <label for="star-4"><i class="fas fa-star"></i></label>
                                        <input class="myRate" type="radio" name="rate" value="3" id="star-3"> <label for="star-3"><i class="fas fa-star"></i></label>
                                        <input class="myRate" type="radio" name="rate" value="2" id="star-2"> <label for="star-2"><i class="fas fa-star"></i></label>
                                        <input class="myRate" type="radio" name="rate" value="1" id="star-1"> <label for="star-1"><i class="fas fa-star"></i></label>
                                      </div>
                                     </div>
                                    </div>
                                  </div>
                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                @csrf
                                <div class="form-group textAreaDiv">
                                    <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="{{__('web.honest_opinion')}}"></textarea>
                                </div>
                                <button type="submit" class="orangeBtn">{{__('web.Post_feedback')}}</button>
                            </form>
                       </div>
                        <hr class="customHr">
                        <div class="studentFeedBack">
                            <h3 class="title">{{__('web.Students_feedback')}}</h3>
                            @foreach($course->comments as $comment)
                                <div class="media">
                                    <img src="{{$comment->user->avatar}}" class="align-self-center mr-3" alt="profile">
                                    <div class="media-body">
                                        <h5 class="mt-0">
                                            <span>{{$comment->user->first_name}} {{$comment->user->last_name}}</span>
                                            <div class="startsBlock d-flex flex-row align-items-center">
                                                <div class="stars">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $comment->rate)
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <span class="fas fa-star"></span>
                                                        @endif
                                                    @endfor
                                                    {{$comment->rate}}
                                                </div>
                                                <span>{{$comment->created_at->diffForHumans()}}</span>
                                            </div>
                                        </h5>
                                        <p class="desc">{{$comment->comment}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div id="myModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="img01">
                <div id="caption"></div>
            </div>
@include('website.layouts.partial.footerDetails')
@endsection
    @push('scripts')
        @include('website.js.myCourse')
    @endpush
