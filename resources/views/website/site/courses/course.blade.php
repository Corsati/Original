@extends('website.layouts.master')
{{--@section('title', '| '. \Illuminate\Support\Str::limit(  $course->getTranslation('title',courseLng($course)) , 59 ,  '...'))--}}

@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')

    <!--start light gray bg-->
    <div class="lightGrayBg pb-2">
        <div class="container">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a onclick="goBack()" href="#"><i
                                    class='fas fa-chevron-left'></i>{{$course->category->name}}</a></li>
                    @if($course->category->parent)
                        <li class="breadcrumb-item active" aria-current="page">{{$course->category->parent->name }}</li>
                    @endif
                </ol>
            </nav>
        </div>
    </div>
    <!--end light gray bg-->

    <!--start course Info bg-->
    <div class="whiteBg">
        <div class="container">
            <div class="courseInfo">
                <div class="courseText" style="width: 100%;">
                    <p>{{$course->getTranslation('title',courseLng($course))}}</p>
                    <p>{{$course->user->first_name}} {{$course->user->last_name}}</p>
                    <div class="d-flex align-items-center flex-wrap">
                        <div class="info d-flex flex-row align-items-center mr-4">
                            <div><img src="{{asset('website/img/book.svg')}}"
                                      alt="calender"> {{count($course->lectures)}} {{__('web.Lecture')}}</div>
                            <div><img src="{{asset('website/img/time.svg')}}"
                                      alt="calender"> {{convertNumbers ( $course->duration->to )}} {{__('web.Hours')}}
                            </div>
                            <div><img src="{{asset('website/img/goal.svg')}}"
                                      alt="calender"> {{level_text($course->level)}} {{__('web.level')}}</div>
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
                    <p class="desc" style="    word-break: break-all;">
                        {{ \Illuminate\Support\Str::limit($course->getTranslation('description',courseLng($course)), 150, $end='...') }}
                    </p>
                    @if($course->discount > 0)
                        <div class="price"><sup>$</sup>{{discountCourse($course->price,$course->discount)}}
                            <span><sup>$</sup>{{$course->price}}</span></div>
                    @else
                        <div class="price"><sup>$</sup>{{ ( float) $course->price}}</span></div>
                    @endif
                    <div class="btns d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            @if(auth()->guest())
                                <a data-toggle="modal" data-target="#loginModal"
                                   class="orangeBtn">{{__('web.Add to Cart')}}</a>
                                <a data-toggle="modal" data-target="#loginModal"
                                   class="orangeBtn grayBtn">{{__('web.Buy now')}}</a>
                                <a data-toggle="modal" data-target="#loginModal" class="orangeBtn purbleClr"
                                   style="margin-right: 10px;margin-left: 10px;"><i class="fas fa-heart"></i></a>
                            @else
                                @if(auth()->user()->hasVerifiedEmail())
                                    @if($course->user_id != auth()->id())
                                        @if(is_null(auth()->user()->userCourses()->where('course_id',$course->id)->first()))
                                            <a class="orangeBtn {{!is_null(isCart($course->id)) ? 'is-cart' : 'carts'}}"
                                               id="addToCart"
                                               data-id="{{$course->id}}"
                                               href="{{route('coursati.addToCart')}}">{{is_null(isCart($course->id)) ?__('web.Add to Cart'): __('web.Empty Cart') }}</a>
                                            <a href="{{route('coursati.buyNow' , ['id' => $course->id])}}"
                                               class="orangeBtn grayBtn">{{__('web.Buy now')}}</a>
                                        @endif
                                    @endif
                                    @if($course->user_id != auth()->id())
                                        <a  data-id="{{$course->id}}" class="orangeBtn {{!is_null(isFavourite($course->id)) ? 'is-favourite' : 'favourites'}}"
                                           id="favourite" style="margin-right: 10px;margin-left: 10px;"><i
                                                    class="fas fa-heart"></i></a>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="courseVedio">
                    <div class="card" style="width: 100%;">
                        <div class="vedioCont">
                            <iframe width="560" height="315"
                                    src="https://www.youtube.com/embed/{{$course->promotional_video_id	}}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </div>
                        <div class="card-body">
                            <h5>{{__('web.This course includes')}}</h5>
                            <hr class="customHr">
                            <ul>
                                @foreach($course->contents as $content)
                                    <li>
                                        <img src="{{asset('website/img/book.svg')}}" alt="book">
                                        <p> {{$content->getTranslation('name',courseLng($course))}}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end course Info bg-->

    <div class="lightGrayBg pb-5">
        <div class="container">
            <div class="courseLearn">
                <h3 class="title">{{__('web.In this course you’ll')}}</h3>
                <div class="learnUl" style="height: auto !important;">
                    <ul>
                        @foreach($course->benefits as $benefit)
                            <li>
                                <span><img src="{{asset('website/img/tick.svg')}}" alt="tick"></span>
                                <p>{{$benefit->getTranslation('name',courseLng($course))}}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="courseContent" style="overflow-y: unset">
                <div class="d-flex justify-content-between align-items-center mb-md-3">
                    <h3 class="title mb-md-0">{{__('web.Course content')}}</h3>
                    <div class="info d-flex align-items-center">
                        <a class="expandAll">{{__('web.Expand all')}} <i class='fas fa-chevron-down'></i></a>
                        <span> {{convertNumbers(count($course->lectures))}} {{__('web.Lectures')}}</span>
                        <span> {{convertNumbers($course->duration->to)}}     {{__('web.Hours')}}   </span>
                    </div>
                </div>
                <div id="accordion" class="myaccordion">
                    @foreach( $course->lectures as $lecture)
                        <div class="card">
                            <div class="card-header whiteBg" id="headingTow{{$lecture->id}}">
                                <h2 class="mb-0">
                                    <button class="w-100 d-flex align-items-center justify-content-between btn btn-link "
                                            data-toggle="collapse" data-target="#collapseTow{{$lecture->id}}"
                                            aria-expanded="true"
                                            aria-controls="collapseTow{{$lecture->id}}">

                                        <div class="headTitle d-flex align-items-center">
                                    <span class="bgLightGray">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                            {{$lecture->getTranslation('name',courseLng($course))}}
                                        </div>

                                        <div class="headInfo d-flex align-items-center">
                                            <span>{{__(convertNumbers(count($lecture->lectureFiles)))}} {{__('web.Lectures')}}</span>
                                        </div>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTow{{$lecture->id}}" class="collapse"
                                 aria-labelledby="headingTow{{$lecture->id}}"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <ul>
                                        @foreach($lecture->lectureFiles as $file)
                                            <li>
                                                <p>   {{$file->getTranslation('name',courseLng($course))}}</p>
                                                <div>
                                                    {{--<span class="review">{{__('web.Review')}}</span>--}}
                                                    <span style="color: #F00">{{$file->video_time}}</span>
                                                </div>
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <h3 class="title">{{__('web.Requirements')}}</h3>
                <ul class="requirment">
                    @foreach($course->requirements as $requirement)
                        <li>
                            <span><img src="{{asset('website/img/info.svg')}}" alt="tick"></span>
                            <p>{{$requirement->getTranslation('name',courseLng($course))}}</p>
                        </li>
                    @endforeach
                </ul>
                <h3 class="title">{{__('web.Description')}}</h3>
                <div class="allDesc">
                    {{$course->getTranslation('description',courseLng($course))}}
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
                                <div><img src="{{asset('website/img/book.svg')}}"
                                          alt="calender"> {{count($course->lectures)}} {{__('web.Lectures')}}</div>
                                <div><img src="{{asset('website/img/time.svg')}}"
                                          alt="calender"> {{$course->duration->to}}   {{__('web.Hours')}}</div>
                                <div><img src="{{asset('website/img/goal.svg')}}"
                                          alt="calender"> {{level_text($course->level)}} {{__('web.level')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{$course->user->instructor->bio}}
                    </div>
                </div>


                <div class="learnNext moreCourses popularInstructors flex-column align-items-start">
                    <h2 class="title">{{__('web.More courses by instructor')}}</h2>
                    <p class="desc">{{__('web.Course that')}}</p>
                    <div id="owl-demo7" class="owl-carousel">
                        @foreach($course->user->courses->where('status','active') as $course)
                            <div class="item">

                                <a href="{{route('coursati.courseDetails',['id' => $course->id , 'name' => make_slug($course->getTranslation('title',courseLng($course)))] )}}"
                                   class="course">
                                    <div class="imgBlock">
                                        <img src="{{$course->image}}" alt="course image">
                                    </div>
                                    <div class="p-3">
                                        <p class="courseName">{{$course->getTranslation('title',courseLng($course))}}</p>
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
                                            <div class="price">
                                                <sup>$</sup>{{discountCourse($course->price , $course->discount)}}<span><sup>$</sup>{{ ( float) $course->price}}</span>
                                            </div>
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
                            <h3 class="title">{{__('web.Student Rating')}}</h3>
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
                            <p>{{__('web.Course rating')}}</p>
                        </div>
                        <div class="rightDiv">
                            <div class="d-flex flex-row align-items-center justify-content-between">
                                <div class="progress progWidth">
                                    @if ($course->comments->where('rate',5)->avg('rate')*10 == 50)
                                        <div class="progress-bar orangeBg" role="progressbar" style="width: 100%"
                                             aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    @else
                                        <span class="progress-bar"></span>
                                    @endif                                </div>
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
                                        <div class="progress-bar orangeBg" role="progressbar" style="width: 75%"
                                             aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
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
                                        <div class="progress-bar orangeBg" role="progressbar" style="width: 50%"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
                                        <div class="progress-bar orangeBg" role="progressbar" style="width: 25%"
                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                                        <div class="progress-bar orangeBg" role="progressbar" style="width: 10%"
                                             aria-valuenow="10" aria-valuemin="10" aria-valuemax="100"></div>
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

                <div class="studentFeedBack">
                    @if(count($course->comments) > 0 )
                        <h3 class="title">{{__('web.Students feedback')}}</h3>
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
                    @endif
                </div>

            </div>
        </div>
    </div>
    @include('website.layouts.partial.footerDetails')
@endsection

@push('scripts')
    @include('website.js.course')
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-606cdc032023b3b9"></script>

@endpush
