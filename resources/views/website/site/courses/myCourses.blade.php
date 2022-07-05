@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <!--start light gray bg-->
    <div class="lightGrayBg pb-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('coursati.index')}}"><i class='fas fa-chevron-left'></i>{{__('web.My Dashboard')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('web.Courses_Certificates')}}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end light gray bg-->
    <div class="lightGrayBg myCoursesTabs categoryCont pb-5 pt-0">
        <div class="container">
            <div class="courseContent mt-0">
                <div class="courseTabs mt-0">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-link active" id="nav-myCourses-tab" data-toggle="tab" href="#nav-myCourses" role="tab" aria-controls="nav-myCourses" aria-selected="true">{{__('web.My courses')}}</a>
                            <a class="nav-link" id="nav-certificates-tab" data-toggle="tab" href="#nav-certificates" role="tab" aria-controls="nav-certificates" aria-selected="false">{{__('web.My certificates')}}</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-myCourses" role="tabpanel" aria-labelledby="nav-myCourses-tab">
                            <div class="topResult d-flex justify-content-between align-items-center mt-20">
                                <div class="resultsNum">
                                    <h4>{{__('web.My courses')}}</h4>
                                    <p>{{__('web.All course available')}}, {{ auth()->user()->userCourses()->count() }} {{__('web.courses')}}</p>
                                </div>
                                <div class="filterBtns d-flex justify-content-center align-items-center">
                                    <a class="listMenu d-none d-lg-flex" href="">
                                        <img src="{{setAsset('website/img/gray_grid.svg')}}" alt="list">
                                    </a>
                                    <a class="gridMenu d-none d-lg-flex" href="">
                                        <img src="{{setAsset('website/img/black_menu.svg')}}" alt="grid list">
                                    </a>
                                </div>
                            </div>
                            <div class="resultsContainer d-flex justify-content-between mt-0">
                                <div class="results ml-0">
                                    <div class="institutesContainer pt-0">
                                        <div class="institutes">
                                            @foreach(auth()->user()->userCourses as $course)
                                                 <a href="{{route('coursati.courseDetails',['id' => $course->course->id , 'name' => make_slug($course->course->getTranslation('title',courseLng($course->course)))])}}"  class="courserBlock d-flex flex-row align-items-center">
                                                    <div class="courseImg" style="position: relative">
                                                        <img src="{{$course->course->image}}" alt="course image">
                                                        @if(round(courseStatus($course)) == '100')
                                                             <img width="25" height="25" src="{{setAsset('website/img/tick.png')}}" style="position: absolute;left: 0; right: 0;margin-left: auto;margin-right: auto;">
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column courseText">
                                                        <div class="d-flex justify-content-between courseText p-0">
                                                            <div class="leftDiv">
                                                                <p>{{$course->course->getTranslation('title',courseLng($course->course))}} </p>
                                                                <p>{{$course->course->user->first_name}} {{$course->course->user->last_name}}  </p>

                                                                <div class="info d-flex flex-row align-items-center">
                                                                    <div><img src="{{setAsset('website/img/book.svg')}}" alt="calender"> {{count($course->course->lectures)}} {{__('web.Lecture')}}</div>
                                                                    <div><img src="{{setAsset('website/img/time.svg')}}" alt="calender"> {{$course->course->duration->to}} {{__('web.total-hours')}}</div>
                                                                    <div><img src="{{setAsset('website/img/goal.svg')}}" alt="calender"> {{($course->course->level()->first()->name)}}</div>
                                                                </div>
                                                                <p class="desc">{{ \Illuminate\Support\Str::limit($course->course->getTranslation('description',courseLng($course->course)), 60, $end = '...') }}</p>
                                                            </div>
                                                            <div class="rightDiv">
                                                                <div class="price">
                                                                    @if($course->course->discount > 0)
                                                                        <div><sup>$</sup>{{discountCourse($course->course->price , $course->course->discount)}}</div>
                                                                        <span><sup>{{$course->course->price}}$</sup></span>
                                                                    @else
                                                                        <div><sup>$</sup>{{$course->course->price}}</div>
                                                                    @endif
                                                                </div>
                                                                <div class=" startsBlock d-flex flex-row align-items-center">
                                                                    <div class="stars">
                                                                        @for ($i = 0; $i < 5; $i++)
                                                                            @if ($i < $course->course->comments->avg('rate'))
                                                                                <i class="fas fa-star"></i>
                                                                            @else
                                                                                <span class="fas fa-star"></span>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                    <span><span>{{round($course->course->comments->avg('rate'),2)}}</span>({{$course->course->comments->count()}})</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column align-items-end">
                                                            <span class="progPercent" style="color: #F00 ; font-size: 18px">{{round(courseStatus($course))}}% completed</span>
                                                            <div class="progress progWidth">
                                                                <div class="progress-bar orangeBg" role="progressbar" style="width: {{courseStatus($course)}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-certificates" role="tabpanel" aria-labelledby="nav-certificates-tab">
                            <div class="topResult d-flex justify-content-between align-items-center mt-20">
                                <div class="resultsNum">
                                    <h4>{{__('web.My Certificates')}}</h4>
                                    <p>{{__('web.Details and quick')}}</p>
                                </div>
                                <div class="filterBtns d-flex justify-content-center align-items-center">
                                    <a class="listMenuCer d-none d-lg-flex" href="">
                                        <img src="{{setAsset('website/img/gray_grid.svg')}}" alt="list">
                                    </a>
                                    <a class="gridMenuCer d-none d-lg-flex mr-0" href="">
                                        <img src="{{setAsset('website/img/black_menu.svg')}}" alt="grid list">
                                    </a>
                                </div>
                            </div>

                            <div class="resultsContainer d-flex justify-content-between mt-0">
                                <div class="results ml-0">
                                    <div class="institutesContainer pt-0">
                                        <div class="institutes">
                                            <!--<div class="media">
                                                <img src="{{setAsset('website/img/certificate.png')}}" class="align-self-center mr-3" alt="certificate">
                                                <div class="media-body">
                                                    <a href="myCourse.html" class="">
                                                        <p>Certificate for  completion</p>
                                                        <h5 class="mt-0">The Web Developer Bootcamp</h5>
                                                        <p class="mb-0">Earned on : 14/7/2025</p>
                                                    </a>
                                                    <div class="d-flex align-items-center">
                                                        <img class="pdfImg" src="{{setAsset('website/img/pdf.png')}}" alt="pdf">
                                                        <a class="downloadPdf">Download PDF</a>
                                                    </div>
                                                </div>
                                            </div>
                                            -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('website.layouts.partial.footerDetails')
@endsection
@push('scripts')
    @include('website.js.myCourses')
@endpush
