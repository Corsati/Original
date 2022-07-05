@extends('website.layouts.master')
@section('content')

    @include('website.layouts.partial.headerDetails')
{{--    @include('website.layouts.partial.navbar')--}}
{{--    @include('website.auth.normalUser.login')--}}
        <div class="content w-78">
            <!--start light gray bg-->
            <div class="lightGrayBg pb-4">
                <div class="container-sm container-md-none px-md-5 py-md-2 pr-120">
                    <!--start my courses-->
                    <div class="myCourses">
                        <div class="d-flex flex-row flex-wrap align-items-center justify-content-between justify-content-lg-center justify-content-xl-between">
                            <div class="hi d-flex flex-row align-items-center">
                                <img src="{{auth()->user()->avatar}}" class="hiImg" alt="hi">
                                <div class="d-flex flex-column welcome">
                                    <p>{{__('web.welcome')}} , {{auth()->user()->first_name}}</p>
                                    <p style="font-size: 12px">{{__('web.ready')}}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                 <div class=" d-flex flex-wrap flex-row align-items-center">
                                   @foreach( auth()->user()->courses->where('steps', '!=' ,'three')->take(2)  as $course )

                                         <a href="{{navigateToCourse($course)}}" class=" courserBlock d-flex flex-row align-items-center mr-18">
                                             <div class="courseImg">
                                                 <img src="{{$course->image ? $course->image : setAsset('website/img/featuredimage.jpeg')}}" data-src="{{$course->image ? $course->image : setAsset('website/img/featuredimage.jpeg')}}" alt="course image">
                                             </div>
                                             <div class="d-flex flex-column courseText">
                                                 <p>{{ $course->title  }}</p>
                                                 <p>{{$course->created_at->diffForHumans()}}</p>
                                                 <div class="progress progWidth">
                                                     <div class="progress-bar orangeBg" role="progressbar" style="width: {{courseProgress($course)}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                 </div>
                                             </div>
                                         </a>
                                     @endforeach
                                 </div>
                                <a href="{{route('coursati.chooseCategory')}}" class="gradientBg">
                                    {{__('web.create_new')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--end my courses-->
                    <!--start top categories-->
                    <div class="topCat pt-2">
                        <h2 class="title">{{__('web.select_category')}}</h2>
                        <p class="desc">{{__('web.select-category-desc')}}</p>
                        <div class="categories">
                            @foreach(auth()->user()->categories as $category)
                            <a href="{{route('coursati.createCourse',[ 'id' => $category->id , 'name' => seoUrl($category->name)])}}" class="cat d-inline-flex flex-column justify-content-center">
                                <img src="{{$category->icon}}" alt="{{$category->metadata}}">
                                <h4>{{$category->name}}</h4>
                                <div><span>{{count(auth()->user()->courses()->where('category_id',$category->id)->get())}}</span> {{__('web.courses-tutorials')}}</div>
                            </a>
                            @endforeach
                            <a href="{{route('coursati.chooseCategory')}}" class="cat viewAll d-inline-flex flex-column justify-content-center">
                                <i class="fas fa-arrow-right"></i>
                                <h4>{{__('web.all_categories')}}</h4>
                            </a>
                        </div>
                    </div>
                    <!--end top categories-->
                    <!--start have ques-->
                    <div class="haveQues">
                        <h2 class="title">{{__('web.contact')}}</h2>
                        <a href="{{route('coursati.contactUs')}}" class="orangeBtn">{{__('web.contact_us')}}</a>
                    </div>
                    <!--end have ques-->
                </div>
            </div>
            <!--end light gray bg-->
                   @include('website.layouts.partial.footerDashboard')
        </div>
    </div>
@endsection
