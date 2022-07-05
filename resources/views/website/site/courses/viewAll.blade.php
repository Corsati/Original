@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <!--start light gray bg-->
    <div class="lightGrayBg categoryCont pb-2">
        <div class="container">
            <div class="resultsContainer d-flex justify-content-between mt-0">
                <div class="results ml-0 w-100">
                    <div class="institutesContainer pt-0">
                        <div class="institutes" id="course-container">
                            @foreach($courses as $course)
                                <a href="{{route('coursati.courseDetails',['id' => $course->id , 'name' => make_slug($course->getTranslation('title',courseLng($course)))])}}"  class="courserBlock d-flex flex-row align-items-center">
                                    <div class="courseImg">
                                        <img src="{{$course->image}}" alt="course image">
                                    </div>
                                    <div class="d-flex justify-content-between courseText">
                                        <div class="leftDiv">
                                            <p>{{$course->getTranslation('title',courseLng($course))}}</p>
                                            <p>{{$course->user->first_name}} {{$course->user->last_name}}</p>
                                            <div class="info d-flex flex-row align-items-center">
                                                <div><img src="{{setAsset('website/img/book.svg')}}" alt="calender"> {{ convertNumbers( count($course->lectures))}} {{__('web.Lecture')}}</div>
                                                <div><img src="{{setAsset('website/img/time.svg')}}" alt="calender"> {{ convertNumbers($course->total_hours) }} {{__('web.total-hours')}}</div>
                                                <div><img src="{{setAsset('website/img/goal.svg')}}" alt="calender"> {{ level_text($course->level)}}</div>
                                            </div>
                                            <p class="desc">{{ \Illuminate\Support\Str::limit($course->getTranslation('description',courseLng($course)), 200, '...') }}</p>
                                        </div>
                                        <div class="rightDiv">
                                            <div class="price">
                                                @if($course->discount > 0)
                                                    <div><sup>$</sup>{{discountCourse($course->price , $course->discount)}}</div>
                                                    <span><sup>{{$course->price}}$</sup></span>
                                                @else
                                                    <div><sup>$</sup>{{$course->price}}</div>
                                                @endif
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
                                </a>
                            @endforeach
                        </div>
                        <div class="bottomNav">
                            {{ $courses->links('pagination.default') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end light gray bg-->
    @include('website.layouts.partial.footerDetails')
@endsection

