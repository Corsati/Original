@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <!--start light gray bg-->
    <div class="lightGrayBg guestGray">
        <div class="container">

            @if($offer)
            <!--start slider bg-->
            <div class="sliderBg guestBg d-md-flex" style="background:url({{$offer->image}}) no-repeat center center">
                <div class="sliderText ">
                    <p class="titleText"> {{$offer->title}} <span> {{$offer->sub_title}} </span></p>
                    <p class="blackText">
                        {{$offer->description}}
                    </p>
                    <p class="grayText">{{__('web.This offer Ends')}} {{\Carbon\Carbon::parse($offer->expire_date)->translatedFormat('l jS F Y')}}.</p>
                    @if($offer->open_counter)
                    <div id="clockdiv">
                        <div class="count">
                            <span class="days"></span>
                            <div class="smalltext">{{__('web.Days')}}</div>
                        </div>
                        <span class="colMark">:</span>
                        <div class="count">
                            <span class="hours"></span>
                            <div class="smalltext">{{__('web.Hours')}}</div>
                        </div>
                        <span class="colMark">:</span>
                        <div class="count">
                            <span class="minutes"></span>
                            <div class="smalltext">{{__('web.Minutes')}}</div>
                        </div>
                        <span class="colMark">:</span>
                        <div class="count">
                            <span class="seconds"></span>
                            <div class="smalltext">{{__('web.Seconds')}}</div>
                        </div>
                    </div>
                   @endif
                </div>
             </div>
            @endif
            <!--end slider bg-->
            <!--start selection courses-->
            <div class="recommended">
                <h2 class="title">{{__('web.Great selection')}}</h2>
                <p class="desc">{{__('web.Based on')}}</p>

                <div class="d-flex align-items-center justify-content-between scrollDiv">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        @foreach($categories as $recommends)
                        <li class="nav-item section-data list-item" data-id="{{$recommends->id}}" role="presentation" style="margin-left: 15px !important;">
                            <a class="nav-link {{ $loop->first ? 'active' : ''}}" id="pills-Business-tab" data-toggle="pill" href="#pills-Business" role="tab" aria-controls="pills-Business" aria-selected="true">{{$recommends->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{route('coursati.search')}}" class="viewAll">
                            <span>{{__('web.viewAll')}}</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-Business" role="tabpanel" aria-labelledby="pills-Business-tab">
                            <div class="d-flex justify-content-between align-items-center flex-wrap" id="courses-tab">
                            </div>
                    </div>
                </div>
            </div>
            <!--end selection courses-->
            <!--start Visitors viewing-->
            <div class="learnNext">
                <h class="title">{{__('web.Visitors are viewing')}}</h>
                <p class="desc">{{__('web.Course that our regular')}}</p>
                <div  id="owl-demo2"  class="owl-carousel owl-theme ">
                    @foreach($courses as $course)
                        <div class="item">
                            <a href="{{route('coursati.courseDetails',['id' => $course->id , 'name' => make_slug($course->getTranslation('title',courseLng($course)))] )}}" class="course">
                                <div class="imgBlock">
                                    <picture>
                                        <source srcset="{{$course->image}}" type="image/webp">
                                        <source srcset="{{$course->image}}" type="image/jpeg">
                                        <img data-src="{{$course->image}}"  src="{{$course->image}}" alt="{{$course->getTranslation('title',courseLng($course))}}">
                                    </picture>
                                </div>
                                <div class="p-3">
                                    <p class="courseName">{{ \Illuminate\Support\Str::limit($course->getTranslation('title',courseLng($course)), 20, '...') }}</p>
                                    <p class="instructor">{{$course->user->first_name}} {{$course->user->last_name}}</p>
                                    <div class=" startsBlock d-flex flex-row align-items-center">
                                        <div class="stars">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $course->comments->avg('rate'))
                                                    <i class="fas fa-star active"></i>
                                                @else
                                                    <i class="fas fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span><span>{{round($course->comments->avg('rate'),2)}}</span>({{$course->comments->count()}})</span>
                                    </div>
                                    @if($course->discount > 0)
                                        <div><sup>$</sup>{{discountCourse($course->price,$course->discount)}}</div>
                                    @endif
                                    <span><sup>$</sup>{{$course->price}}</span>

                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            </div>

            <!--end Visitors viewing-->
        </div>
    </div>

    @if(auth()->guest())
        <div class="personalization">
            <h2 class="title">{{__('web.Get personalized')}}</h2>
            <p class="desc">{{__('web.Answer')}}</p>
            <a data-toggle="modal" data-target="#signUpModal" class="orangeBtn">{{__('web.Get started')}}</a>
        </div>
    @endif
    <div class=" lightGrayBg">
        <div class="container">
            <!--start top categories-->
            <div class="topCat">
                <h2 class="title">{{__('web.Top categories')}}</h2>
                <p class="desc">{{__('web.Categories that we')}}</p>
                <div class="categories" id="popular-categories"></div>
            </div>
            <!--end top categories-->

            <!--start Institutes and centrals-->
            <div class="institutesContainer">
                <h2 class="title">{{__('web.Institutes and centrals')}}</h2>
                <p class="desc">{{__('web.Locations courses')}}</p>
                <div class="institutes">

                    <div class="middle" style="width: 100%">
                        <h1 style="text-align: center;color: #E13A7E">{{__('web.COMING SOON')}}</h1>
                    </div>
                 </div>
            </div>
            <!--end Institutes and centrals-->
        </div>
    </div>
    @include('website.layouts.partial.footerDetails')
@endsection

@push('scripts')
    <script type="text/javascript">

    </script>
@endpush