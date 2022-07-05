@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <!--start light gray bg-->
    <div class="lightGrayBg">
        <div class="container" style="background-color: #f7f7f7">
            @if(!auth()->guest())
                @if(auth()->user()->email_verified_at == null)
                    <div class="alert alert-danger" role="alert">

                        {{ __('Before proceeding') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                @endif
            @endif
            @if($offer)
            <!--start slider bg-->
                    @if(App::getLocale() == 'en')
                        <div class="sliderBg" style="background-image: url({{$offer->image}}) !important;" >
                    @else
                        <div class="sliderBg" style="background-image: url({{$offer->image_ar}}) !important;" >
                    @endif
                    <div class="sliderText d-none d-md-block">
                    <p class="titleText">{{$offer->title}} <span>{{$offer->sub_title}}</span></p>
                    <p class="blackText">
                        {{$offer->description}}
                    </p>
                     <p class="grayText">{{__('web.This offer Ends')}} {{\Carbon\Carbon::parse($offer->expire_date)->translatedFormat('l jS F Y')}}.</p>
                     @if($offer->have_url)
                        <a class="gradientBg" href="{{$offer->url}}" target="_blank" id="pills-Business-tab"   >{{__('web.watch')}}</a>
                    @endif
                    </div>

            </div>
              @endif
            <!--end slider bg-->

            <!--start my courses-->
            @if(count(auth()->user()->userCourses) > 0)
            <div class="myCourses">

                <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">

                    <div class="hi d-flex flex-row align-items-center">
                        <img src="{{asset('website/img/hi.svg')}}" class="hiImg" alt="hi">
                        <div class="d-flex flex-column welcome">
                            <p>{{__('web.welcome_back')}} {{auth()->user()->first_name}}</p>
                            <p>{{__('web.ready')}}</p>
                        </div>
                    </div>
                    @foreach(auth()->user()->userCourses()->limit(2)->get() as $course)
                    <div class=" d-flex flex-wrap flex-row align-items-center">
                        <a href="{{route('coursati.courseDetails',['id' => $course->course->id , 'name' => make_slug($course->course->title)])}}" class=" courserBlock d-flex flex-row align-items-center mr-18">
                            <div class="courseImg">
                                <img src="{{$course->course->image}}" data-src="{{$course->course->image}}" alt="course image">
                            </div>
                            <div class="d-flex flex-column courseText">
                                <p>{{ \Illuminate\Support\Str::limit($course->course->getTranslation('title',courseLng($course->course)), 40, $end = '...') }}</p>
                                <p>{{$course->course->user->first_name}} {{$course->course->user->last_name}}</p>
                                <div class="progress progWidth">
                                    <div class="progress-bar orangeBg" role="progressbar" style="width: {{courseStatus($course)}}%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    <a href="{{route('coursati.myCourses')}}" class="coursesLink">
                        <span>{{__('web.My courses')}}</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>

            </div>
        @endif
            <!--end my courses-->

            <!--start recommended courses-->
            <div class="recommended">
                <h2 class="title">{{__('web.Recommended courses')}}</h2>
                <p class="desc">{{__('web.The highest visited')}}</p>

                <div class="d-flex align-items-center justify-content-between scrollDiv">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        @foreach($categories as $recommends)
                            <li class="nav-item section-data" data-id="{{$recommends->id}}" role="presentation">
                                <a class="nav-link {{ $loop->first ? 'active' : ''}}" id="pills-Business-tab" data-toggle="pill" href="#pills-Business" role="tab" aria-controls="pills-Business" aria-selected="true">{{$recommends->name}}</a>
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{route('coursati.explore-categories')}}" class="viewAll">
                        <span>{{__('web.View All')}}</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-Business" role="tabpanel" aria-labelledby="pills-Business-tab">
                        <div class="d-flex justify-content-between align-items-center flex-wrap"  id="courses-tab">
                        </div>
                    </div>
                </div>

            </div>
            <!--end recommended courses-->

            <!--start learn next-->
            <div class="learnNext">
                <h2 class="title">{{__('web.What to learn next')}}</h2> <!-- course.html -->
{{--                <p class="desc">{{__('web.Because you viewed')}} <a href="#">“Learn to Draw Pretty Faces for Comic Books”</a></p>--}}
                <div id="owl-demo1" class="owl-carousel">
                   @foreach($toLearnCourses as $toLearnCourse)

                    <div class="item">
                        <a href="{{route('coursati.courseDetails',['id' => $toLearnCourse->id , 'name' => make_slug( $toLearnCourse->getTranslation('title',courseLng($toLearnCourse)) )])}}" class="course">
                            <div class="imgBlock">
                                <img src="{{$toLearnCourse->image}}" alt="course image">
                            </div>
                            <div class="p-3">
                                <p class="courseName">{{ \Illuminate\Support\Str::limit($toLearnCourse->getTranslation('title',courseLng($toLearnCourse)), 45, $end='...') }}</p>
                                <p class="instructor">{{$toLearnCourse->user->first_name}} {{$toLearnCourse->user->last_name}}</p>
                                <div class=" startsBlock d-flex flex-row align-items-center">
                                    <div class="stars">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $toLearnCourse->comments->avg('rate'))
                                                <i class="fas fa-star"></i>
                                            @else
                                                <span class="fas fa-star"></span>
                                            @endif
                                        @endfor
                                    </div>
                                    <span><span>{{round($toLearnCourse->comments->avg('rate'),2)}}</span>({{$toLearnCourse->comments->count()}})</span>
                                </div>
                                @if($toLearnCourse->discount > 0)
                                    <div class="price"><sup>$</sup>{{discountCourse($toLearnCourse->price , $toLearnCourse->discount)}}<span><sup>$</sup>{{ ( float) $toLearnCourse->price}}</span></div>
                                @else
                                    <div class="price"><sup>$</sup>{{ ( float) $toLearnCourse->price}}</span></div>
                                @endif
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

            </div>
            <!--end learn next-->

            <!--start top courses-->
            <div class="learnNext">
                <h2 class="title">{{__('web.Top courses')}}</h2>
                <div id="owl-demo2" class="owl-carousel" >
                    @foreach($courses as $course)
                    <div class="item">
                        <a href="{{route('coursati.courseDetails',['id' => $course->id , 'name' => make_slug($course->getTranslation('title',courseLng($course)))])}}" class="course">
                            <div class="imgBlock">
                                <img src="{{$course->image}}" data-src="{{$course->image}}"  alt="course image">
                            </div>
                            <div class="p-3">
                                <p class="courseName">{{ \Illuminate\Support\Str::limit($course->getTranslation('title',courseLng($course)), 45, $end='...') }}</p>
                                <p class="instructor">{{$course->user->first_name}} {{$course->user->last_name}}</p>
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
            <!--end top courses-->

            @if(count($suggestedCourses) > 0)
            <!--start Suggestion-->
            <div class="learnNext">
                <h2 class="title">{{__('web.Suggestion courses')}} {{$suggestedCourse->first()?$suggestedCourse->first()->name : ''}}</h2>
                <div id="owl-demo3" class="owl-carousel" >
                    @foreach($suggestedCourses as $suggestedCourse)
                    <div class="item">
                        <a href="{{route('coursati.courseDetails',['id' => $suggestedCourse->id , 'name' => make_slug( $suggestedCourse->getTranslation('title',courseLng($suggestedCourse)) )])}}" class="course">
                            <div class="imgBlock">
                                <img src="{{$suggestedCourse->image}}" data-src="{{$suggestedCourse->image}}" alt="course image">
                            </div>
                            <div class="p-3">
                                <p class="courseName">{{ \Illuminate\Support\Str::limit($suggestedCourse->getTranslation('title',courseLng($suggestedCourse)), 45, $end='...') }}</p>
                                <p class="instructor">{{$suggestedCourse->user->first_name}} {{$suggestedCourse->user->last_name}}</p>
                                <div class=" startsBlock d-flex flex-row align-items-center">
                                    <div class="stars">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $suggestedCourse->comments->avg('rate'))
                                                <i class="fas fa-star"></i>
                                            @else
                                                <span class="fas fa-star"></span>
                                            @endif
                                        @endfor
                                    </div>
                                    <span><span>{{round($suggestedCourse->comments->avg('rate'),2)}}</span>({{$suggestedCourse->comments->count()}})</span>
                                </div>
                                @if($suggestedCourse->discount > 0)
                                    <div class="price"><sup>$</sup>{{discountCourse($suggestedCourse->price , $suggestedCourse->discount)}}<span><sup>$</sup>{{ ( float) $suggestedCourse->price}}</span></div>
                                @else
                                    <div class="price"><sup>$</sup>{{ ( float) $suggestedCourse->price}}</span></div>
                                @endif
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <!--end Suggestion-->
          @endif

        </div>
    </div>
    <!--end light gray bg-->

    @include('website.layouts.partial.footerDetails')
@endsection
