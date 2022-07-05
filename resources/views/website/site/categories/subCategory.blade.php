@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <!--start light gray bg-->
    <div class="lightGrayBg categoryCont subCatContainer pb-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @if($category->parent)
                    <li class="breadcrumb-item">
                        <a href="{{route('coursati.category',[$category->parent->id,$category->parent->name])}}"><i class='fas fa-chevron-right'></i>{{$category->parent->name}}</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item">
                        <a href="{{route('coursati.subcategory',[$category->id,$category->name])}}">{{$category->name}}</a>
                    </li>
                </ol>
            </nav>
            <div class="development mt-0">
                <img src="{{$category->icon}}" alt="book">
                <div class="d-flex flex-column justify-content-center">
                    <h2 class="title">
                        {{$category->name}}
                    </h2>
                    <p class="desc">
                        {{$category->name}}
                    </p>
                </div>
            </div>

            @if(count($category->childes) > 0)
            <div class="coursesContainer learnNext p-0">
                <div id="owl-demo4" class="owl-carousel purpleDemo">
                    @foreach($category->childes as $section)
                        @if(count($section->courses) > 0)
                        <a href="{{route('coursati.subSubCategory',[$section->id,$section->name])}}" class="item">
                            {{$section->name}} <span>( {{count($section->courses)}}  )</span>
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            <!--start recommended courses-->
            <div class="recommended learnNext subCat">
                <h2 class="title">{{__('web.Courses started')}}</h2>
                <p class="desc">{{__('web.Based rating')}}</p>

                <div class="d-flex align-items-center justify-content-between">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active popularFilter" id="pills-Popular-tab" data-toggle="pill" href="#pills-Popular" role="tab" aria-controls="pills-Popular" aria-selected="true">{{__('web.Popular')}}</a>
                        </li>
                        @foreach($academics as $academic)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  popularFilter" data-id="{{$academic->id}}" id="pills-Popular-tab" data-toggle="pill" href="#pills-Popular" role="tab" aria-controls="pills-Popular" aria-selected="true">{{$academic->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-Popular" role="tabpanel" aria-labelledby="pills-Popular-tab">
                        <div id="owl-demo6" class="owl-carousel purpleDemo popularCourses">

                        </div>
                    </div>

                </div>

            </div>
            <!--end recommended courses-->
            <!--start top courses-->
            <div class="learnNext">
                <h2 class="title">{{__('web.Top courses')}}</h2>
                <p class="desc">{{__('web.Course that our regular')}}</p>
                <div id="owl-demo2" class="owl-carousel purpleDemo" >
                </div>
            </div>
            <!--end top courses-->
            <div class="topResult d-flex justify-content-between align-items-center mt-20">
                <div class="resultsNum">
                    <h4>{{__('web.All courses in Development')}}</h4>
                    <p>{{__('web.All course available')}}, {{count($category->courses)}} {{__('web.courses')}}</p>
                </div>
                <div class="filterBtns d-flex justify-content-center align-items-center">
                    <select class="selectpicker" id="rating" title="{{__('web.Rating')}}">
                        <option value="0">{{__('web.not_rated')}}</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <select class="selectpicker" id="videoDuration" title="{{__('web.Video duration')}}">
                    <option value="">{{__('web.viewAll')}}</option>
                    @foreach($durations as $duration)
                            <option value="{{$duration->id}}">{{$duration->from}} - {{$duration->to}} {{__('web.Hours')}}</option>
                        @endforeach
                     </select>
                </div>
            </div>
            <div class="resultsContainer d-flex justify-content-between mt-0">
                <div class="results ml-0">
                    <div class="institutesContainer pt-0" id="allCourses">
                        <div class="institutes"  >
                             @include('website.components.category-courses',['courses' => $courses])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end light gray bg-->
    @include('website.layouts.partial.popularInstructor')
    @include('website.layouts.partial.footerDetails')
@endsection
@push('scripts')
    @include('website.js.subCategory')
@endpush