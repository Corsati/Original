@extends('website.layouts.master')
{{--@section('title', '| '. \Illuminate\Support\Str::limit( $category->name , 59 ,  '...'))--}}
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <!--start light gray bg-->
    <div class="lightGrayBg categoryCont subCatContainer pb-2">
        <div class="container">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('coursati.category',[$category->parent->id,$category->parent->name])}}"><i class='fas fa-chevron-right'></i>{{$category->parent->name}}</a>
                    </li>
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
            <!--start Featured course-->
            <div class="institutesContainer featuredCourse">
                <h2 class="title">{{__('web.Featured course')}}</h2>
                <p class="desc">{{__('web.We recommend getting this Course if you’re interested in ')}} {{$category->name}}</p>

                <div class="institutes">
                    <div class="courserBlock d-flex flex-row align-items-center w-100">
                        <div class="courseImg">
                            <img src="{{$recommended->image}}" alt="course image">
                        </div>
                        <div class="courseText">
                            <p>{{$recommended->getTranslation('title',courseLng($recommended))}}</p>
                            <p>{{$recommended->user->first_name}} {{$recommended->user->lasr_name}}</p>
                            <div class="d-flex align-items-center">
                                <div class="info d-flex flex-row align-items-center mr-4">
                                    <div><img src="{{setAsset('website/img/book.svg')}}" alt="calender"> {{convertNumbers(count($recommended->lectures))}} {{__('web.Lectures')}}</div>
                                    <div><img src="{{setAsset('website/img/time.svg')}}" alt="calender"> {{convertNumbers($recommended->duration?$recommended->duration->to :0)}} {{__('web.hours')}}</div>
                                    <div><img src="{{setAsset('website/img/goal.svg')}}" alt="calender"> {{$recommended->level()->first()->name}} </div>
                                </div>
                                <div class=" startsBlock d-flex flex-row align-items-center">
                                    <div class="stars">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $recommended->comments->avg('rate'))
                                                <i class="fas fa-star"></i>
                                            @else
                                                <span class="fas fa-star"></span>
                                            @endif
                                        @endfor
                                    </div>
                                    <span><span>{{round($recommended->comments->avg('rate'),2)}}</span>({{$recommended->comments->count()}})</span>
                                </div>
                            </div>
                            <p class="desc">{{substr($recommended->getTranslation('description',courseLng($recommended)) ,50)}}</p>
                            @if($recommended->discount > 0)
                                <div><sup>$</sup>{{discountCourse($recommended->price , $recommended->discount)}}</div>
                            @else
                                <span><sup>$</sup>{{$recommended->price}}</span>
                            @endif
                            <a href="{{route('coursati.courseDetails',['id' => $recommended->id , 'name' => make_slug($recommended->getTranslation('description',courseLng($recommended)))])}}"  class="orangeBtn purbleBg" >{{__('web.Explore course')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end Featured course-->
            <div class="topResult d-flex justify-content-between align-items-center mt-20">
                <div class="resultsNum">
                    <h4>{{__('web.All courses in Development')}} {{$category->name}}</h4>
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
    @include('website.js.subSubCategory')
@endpush