@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <style type="text/css">
        .is-favourite{
            background-color: #e13a7d !important;
            color: #F2F2F2  !important;
        }
        .favourites{
            background-color: #F2F2F2 !important;
            color: #e13a7d  !important;
        }

        .is-cart{
            background-color: #ff7600 !important;
            color: #F2F2F2  !important;
        }
        .carts{
            background-color: #F2F2F2 !important;
            color: #ff7600  !important;
        }
        .plyr__video-embed iframe {
            top: -50%;
            height: 200%;
        }
        .videoWrapper {
            overflow: hidden;
        }
        @media (min-width: 1500px) {
            .videoWrapper {
                margin-top: -135px;
            }
        }
        @media (min-width: 1200px) {
            .videoWrapper {
                margin-top: -75px;
            }
        }
    </style>
    <!--start light gray bg-->
    <div class="lightGrayBg pb-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=""><i class='fas fa-chevron-left'></i>{{$course->category->name}}</a></li>
                    @if($course->category->parent)
                        <li class="breadcrumb-item active" aria-current="page">{{$course->category->parent->name }}</li>
                    @endif
                </ol>
            </nav>
        </div>
    </div>
    <!--end light gray bg-->

    <!--start course Info bg-->
    <div class="whiteBg myCourse">
        <div class="container">
            <div class="courseInfo">
                <div class="courseText d-flex justify-content-between align-items-center">
                    <div class="leftDiv">
                        <p>{{$course->title}}</p>
                        <p>{{$course->user->first_name}} {{$course->user->last_name}}</p>
                        <p class="desc">
                            {{ \Illuminate\Support\Str::limit($course->description, 150, $end='...') }}
                        </p>
                    </div>
                    <div class="rightDiv">
                        <div class="btns d-flex align-items-center">
                            <a class="orangeBtn {{!is_null(isFavourite($course->id)) ? 'is-favourite' : 'favourites'}}" id="favourite"   style="margin-right: 10px;margin-left: 10px;"><i class="fas fa-heart"></i></a>
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-start">
                            <div class="info d-flex flex-column justify-content-center">
                                <div><img src="{{setAsset('website/img/book.svg')}}" alt="calender"> {{count($course->lectures)}} {{__('web.Lecture')}}</div>
                                <div><img src="{{setAsset('website/img/time.svg')}}" alt="calender"> {{$course->total_hours}} {{__('web.total-hours')}}</div>
                                <div><img src="{{setAsset('website/img/goal.svg')}}" alt="calender"> {{level_text($course->level)}}</div>

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
                <div class="vedioCont playerWrap videoWrapper " id="player" style="margin-top: 20px">
                    {{--                    <video   width="560" height="315"   controls preload="none" >--}}
                    {{--                        <source src="{{$course->promotional_video}}" type="video/mp4" autostart="false">--}}
                    {{--                        <source src="{{$course->promotional_video}}" type="video/ogg" autostart="false">--}}
                    {{--                        Your browser does not support the video tag.--}}
                    {{--                    </video>--}}
                </div>


                <div class="courseContent" style="margin-top: 20px">
                    <div id="accordion" class="myaccordion" >
                        @foreach($course->lectures as $lecture)
                            <div class="card">
                                <div class="card-header" id="headingOne {{$lecture->id}}">
                                    <h2 class="mb-0">
                                        <button class="w-100 d-flex align-items-center justify-content-between btn btn-link "
                                                data-toggle="collapse" data-target="#collapseOne{{$lecture->id}}" aria-expanded="true"
                                                aria-controls="collapseOne{{$lecture->id}}">

                                            <div class="headTitle d-flex align-items-center">
                                            <span>
                                                <i class="fas fa-minus"></i>
                                            </span>
                                                {{$lecture->name}}
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

                                                <li>
                                                    <p> - {{$file->name}}</p>
                                                </li>
                                                <li class="lightGrayBg">
                                                    <img src="{{setAsset('website/img/play.png')}}" alt="play" class="click" data-id="{{$file->video_id}}">

                                                    <div class="w-100">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <p> -{{$file->name}}</p>
                                                            <div>
                                                                <span class="review">Review</span>
                                                                <span>{{$file->video_time}}</span>
                                                            </div>
                                                        </div>
                                                        <div >
                                                            <input class="progress-bar orangeBg " style="width: 100%;color: orange" type="range" id="progress{{$file->video_id}}" value="0" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" >
                                                        </div>
                                                    </div>
                                                </li>
                                        @endforeach
                                        <!--
                                        <li>
                                            <p> - A Note On Asking For Help</p>
                                            <div>
                                                <span>2 Pages</span>
                                            </div>
                                        </li>
                                        -->
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
            <div class="courseContent mt-0">

                <div class="courseTabs">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link" id="nav-Description-tab" data-toggle="tab" href="#nav-Description" role="tab" aria-controls="nav-Description" aria-selected="true">{{__('web.Description')}}</a>
                            <a class="nav-link active" id="nav-qA-tab" data-toggle="tab" href="#nav-qA" role="tab" aria-controls="nav-qA" aria-selected="false">{{__('web.Q_A')}}</a>
                            <a class="nav-link" id="nav-learn-tab" data-toggle="tab" href="#nav-learn" role="tab" aria-controls="nav-learn" aria-selected="false">{{__('web.In this course you’ll')}}</a>
                            <a class="nav-link" id="nav-Requirements-tab" data-toggle="tab" href="#nav-Requirements" role="tab" aria-controls="nav-Requirements" aria-selected="false">{{__('web.Requirements')}}</a>
                            {{--                            <a class="nav-link" id="nav-files-tab" data-toggle="tab" href="#nav-files" role="tab" aria-controls="nav-files" aria-selected="false">Course files</a>--}}
                            <a class="nav-link" id="nav-Certificate-tab" data-toggle="tab" href="#nav-Certificate" role="tab" aria-controls="nav-Certificate" aria-selected="false">{{__('web.Certificate task')}}</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade" id="nav-Description" role="tabpanel" aria-labelledby="nav-Description-tab">
                            {{__('web.Description')}}
                            <p class="desc">
                                {{ \Illuminate\Support\Str::limit($course->description, 150, $end='...') }}
                            </p>
                        </div>
                        <div class="tab-pane fade show active" id="nav-qA" role="tabpanel" aria-labelledby="nav-qA-tab">
                            <h3 class="title">{{__('web.Chat With Teacher')}}</h3>
                        <!--
                            <div class="chatContainer">

                                <div class="chatHead">
                                    <img src="{{$course->user->avatar}}" class="align-self-center mr-3" alt="profile">
                                    <span>{{$course->user->first_name}} {{$course->user->last_name}}</span>
                                </div>

                                <div class="chatBox">
                                    <div class="mainDate">
                                        <div class="line"></div>
                                        <div class="date">10 Oct. 2020</div>
                                    </div>

                                    <div class="rightCont">
                                        <div class="rightText">
                                            hello , are you there ?
                                        </div>
                                        <div class="time">
                                            <i class="fas fa-check-double"></i>
                                            30 minutes ago
                                        </div>
                                    </div>

                                    <div class="leftCont">
                                        <div class="leftText">
                                            How can I help You?
                                        </div>
                                        <div class="time">
                                            30 minutes ago
                                        </div>
                                    </div>

                                    <div class="rightCont">
                                        <div class="rightText">
                                            I have a problem with lesson #13, could you pl..

                                        </div>
                                        <div class="time">
                                            <i class="fas fa-check"></i>
                                            30 minutes ago
                                        </div>
                                    </div>

                                    <div class="leftCont">
                                        <div class="leftText">
                                            How can I help You?
                                        </div>
                                        <div class="time">
                                            30 minutes ago
                                        </div>
                                    </div>

                                    <div class="rightCont">
                                        <div class="rightText">
                                            I have a problem with lesson #13, could you pl..

                                        </div>
                                        <div class="time">
                                            <i class="fas fa-check"></i>
                                            30 minutes ago
                                        </div>
                                    </div>

                                    <div class="leftCont">
                                        <div class="leftText">
                                            How can I help You?
                                        </div>
                                        <div class="time">
                                            30 minutes ago
                                        </div>
                                    </div>

                                    <div class="rightCont">
                                        <div class="rightText">
                                            I have a problem with lesson #13, could you pl..

                                        </div>
                                        <div class="time">
                                            <i class="fas fa-check"></i>
                                            30 minutes ago
                                        </div>
                                    </div>


                                </div>

                                <div class="chatFooter">
                                    <form action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="msg" placeholder="Type here ..">
                                        </div>
                                        <button type="submit" class="orangeBtn">Send</button>
                                        <div class="form-group paperClip">
                                            <input id="photo-upload" class="uploadFile" name='upload_cont_file' type="file">
                                            <a class=""><i class="fas fa-paperclip"></i></a>
                                        </div>

                                    </form>
                                </div>

                            </div>
                            -->
                        </div>
                        <div class="tab-pane fade" id="nav-learn" role="tabpanel" aria-labelledby="nav-learn-tab">
                            <div class="courseLearn">
                                <h3 class="title">{{__('web.In this course you’ll')}}</h3>
                                <div class="learnUl w-100">
                                    <ul>
                                        @foreach($course->benefits as $benefit)
                                            <li>
                                                <span><img src="{{asset('website/img/tick.svg')}}" alt="tick"></span>
                                                <p>{{$benefit->name}}</p>
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
                                                <p>{{$requirement->name}}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-Certificate" role="tabpanel" aria-labelledby="nav-Certificate-tab">
                            <div class="courseLearn">
                                <h3 class="title">{{__('web.Certificates')}}</h3>
                                <div class="requirment w-100">
                                    <div>
                                        @foreach($course->certificates as $certificate)
                                            <div style="    display: flex;justify-content: space-around;}">
                                                <span><img src="{{asset('website/img/info.svg')}}" alt="tick"></span>
                                                <p>{{$certificate->title}}</p>
                                                <a href="{{$certificate->file}}" target="_blank" class="orangeBtn">{{__('web.download')}}</a>
                                            </div>
                                        @endforeach
                                    </div>
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
                                <div><img src="{{asset('website/img/time.svg')}}" alt="calender"> {{$course->total_hours}}   {{__('web.Hours')}}</div>
                                <div><img src="{{asset('website/img/goal.svg')}}" alt="calender"> {{level_text($course->level)}} {{__('web.level')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="learnNext moreCourses popularInstructors flex-column align-items-start">
                    <h2 class="title">{{__('web.More courses by instructor')}}</h2>
                    <p class="desc">{{__('web.Course that')}}</p>
                    <div id="owl-demo7" class="owl-carousel">
                        @foreach($course->user->courses->where('steps','three')->where('status','active') as $course)
                            <div class="item">
                                <a href="{{route('coursati.courseDetails',['id' => $course->id , 'name' => make_slug($course->name)])}}"  class="course">
                                    <div class="imgBlock">
                                        <img src="{{$course->image}}" alt="course image">
                                    </div>
                                    <div class="p-3">
                                        <p class="courseName">{{$course->title}}</p>
                                        <p class="instructorName">{{$course->user->first_name}} {{$course->user->last_name}}</p>
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
                                        @if($course->discount > 0)
                                            <div class="price"><sup>$</sup>{{discountCourse($course->price , $course->discount)}}<span><sup>$</sup>{{ ( float) $course->price}}</span></div>
                                        @else
                                            <div class="price"><sup>$</sup>{{ ( float) $course->price}}</span></div>
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

                                <div class="startsBlock d-flex flex-row align-items-center" style="padding-right: 15%">
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
                                <div class="startsBlock d-flex flex-row align-items-center" style="padding-right: 15%">
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
                                <div class="startsBlock d-flex flex-row align-items-center" style="padding-right: 15%">
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
                                <div class="startsBlock d-flex flex-row align-items-center" style="padding-right: 15%">
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
                                <div class="startsBlock d-flex flex-row align-items-center" style="padding-right: 15%">
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
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="title">{{__('web.My_feedback')}}</h3>
                        <div class="startsBlock d-flex flex-row align-items-center">
                            <form action="{{route('coursati.comment')}}" method="post" class="ajaxCommentSubmit" id="addStar">
                                @csrf
                                <div class="rating-box">
                                    <div class="rating-container" style="padding-bottom: 15%">
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


    @include('website.layouts.partial.footerDetails')
@endsection
@push('scripts')
    <script src="http://www.youtube.com/player_api"></script>

    <script type="text/javascript">
        $(document).on('ready',function (){
            onYouTubePlayerAPIReady();
            document.getElementsByTagName('iframe')[0].contentWindow.getElementsByClassName('ytp-watch-later-button')[0].style.display = 'none';

        });

        var player;
        var videoId     = '{{$course->promotional_video_id}}';
        var time_update_interval = 0;
        function onYouTubePlayerAPIReady() {
            player     = new YT.Player('player', {
                height  : '390',
                width   : '640',
                playerVars: {
                    'autoplay': 1,
                    'controls': 1,
                    'autohide': 1,
                    'showinfo' : 0, // <- This part here
                    'wmode': 'opaque',
                    'rel': 0,
                    'loop': 0
                },
                videoId : '{{$course->promotional_video_id}}',
                events  : {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        // autoplay video
        function onPlayerReady(event) {
            // Clear any old interval.
            clearInterval(time_update_interval);
            // Start interval to update elapsed time display and
            // the elapsed part of the progress bar every second.
            time_update_interval = setInterval(function () {
                updateTimerDisplay();
                updateProgressBar();
            }, 1000)
            event.target.playVideo();
        }

        // This function is called by initialize()
        function updateTimerDisplay(){
            // Update current time text display.
            $('#current-time').text(formatTime( player.getCurrentTime() ));
            $('#duration')    .text(formatTime( player.getDuration() ));
        }

        function formatTime(time){
            time = Math.round(time);

            var minutes = Math.floor(time / 60),
                seconds = time - minutes * 60;

            seconds = seconds < 10 ? '0' + seconds : seconds;

            return minutes + ":" + seconds;
        }

        $('#progress'+videoId).on('mouseup touchend', function (e) {
            // Calculate the new time for the video.
            // new time in seconds = total duration in seconds * ( value of range input / 100 )
            var newTime = player.getDuration() * (e.target.value / 100);

            // Skip video to new time.
            player.seekTo(newTime);

        });

        // This function is called by initialize()
        function updateProgressBar(){
            // Update the value of our progress bar accordingly.
            $('#progress'+videoId).val((player.getCurrentTime() / player.getDuration()) * 100);
        }

        // ('#play').on('click', function () {
        //
        //     player.playVideo();
        //
        // });

        $('#pause').on('click', function () {

            player.pauseVideo();

        });

        $('#mute-toggle').on('click', function() {
            var mute_toggle = $(this);

            if(player.isMuted()){
                player.unMute();
                mute_toggle.text('volume_up');
            }
            else{
                player.mute();
                mute_toggle.text('volume_off');
            }
        });

        $('#volume-input').on('change', function () {
            player.setVolume($(this).val());
        });

        $('#speed').on('change', function () {
            player.setPlaybackRate($(this).val());
        });

        $('#quality').on('change', function () {
            player.setPlaybackQuality($(this).val());
        });
        // when video ends
        function onPlayerStateChange(event) {
            if(event.data === 0) {
                alert('done');
            }
        }

        $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
            $(e.target).prev().find("i:last-child").toggleClass("fa-minus fa-plus");
            $(e.target).prev().toggleClass("whiteBg");
            $(e.target).prev().find('.headTitle span').toggleClass("bgLightGray");
        });

        $(".expandAll").click(function () {
            $("#accordion").find("i:last-child").removeClass("fa-plus").addClass('fa-minus');
            $("#accordion").find('.card-header').removeClass("whiteBg");
            $("#accordion").find('.headTitle span').removeClass("bgLightGray");
            $("#accordion").find('.collapse').addClass("show");
        });

        $(document).on('click','#favourite',function (){
            $.ajax({
                type                     : "POST",
                url                      : "{{route('coursati.favourite')}}",
                dataType                 : "json",
                data                     : {
                    _token               : '{{csrf_token()}}',
                    id                   : '{{$course->id}}'
                },
                success: function (data) {
                    if(data.isFav)
                    {
                        $('#favourite').removeClass('favourites')
                        $('#favourite').addClass('is-favourite')
                        toastr.success(data.msg)
                    }else{
                        $('#favourite').removeClass('is-favourite')
                        $('#favourite').addClass('favourites')
                        toastr.error(data.msg)
                    }
                }
            });
        });

        //   ================== IFrame ===================
        $(".click").click(function() {
            videoId      = $(this).data('id');
            player.loadVideoById( $(this).data('id'))
        });
    </script>
    <script>
        $(document).on('submit','.ajaxCommentSubmit',function(e) {
            e.preventDefault()
            var url = $(this).attr('action')
            jQuery('.alert-danger').hide()
            $.ajax({
                url         : url,
                method      : 'post',
                data        : new FormData($(this)[0]),
                processData : false,
                contentType : false,
                success     : function (response) {
                    window .location.reload();
                    toastr.success('{{__('web.Successfully_Add_Comment')}}')
                },
                error: function (xhr) {
                    $('.error_messages')    .remove();
                    $('#comment input')  .removeClass('border-danger')
                    $.each(xhr.responseJSON .errors, function (key, value) {
                        $('#comment[name=' + key + ']')  .after('<small class="form-text error_messages text-danger">' + value + '</small>');
                    });
                },
            })
        })
    </script>

    <script>
        $('#addStar').change('.star', function(e) {
            $(this).count('.count');
        });
    </script>

@endpush
