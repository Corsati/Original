@extends('website.layouts.master')
{{--@section('title', '| '. \Illuminate\Support\Str::limit( $category->name , 59 ,  '...'))--}}

@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <!--start light gray bg-->
    <div class="lightGrayBg categoryCont pb-2" >
        <div class="container minH" >
            <div class="development mt-0">
                <img src="{{$category->icon}}" alt="book">
                <div class="d-flex flex-column justify-content-center">
                    <h2 class="title">
                        {{$category->name}}
                    </h2>
                </div>
            </div>
            <div class="coursesContainer">
                @if(count($category->childes) > 0)
                @foreach($category->childes as $section)
                        <a href="{{route('coursati.subcategory',[$section->id,make_slug($section->name)])}}" class="item">
                            {{$section->name}}  <span style="margin-left: 5px; margin-right: 5px"> ({{ count( $section->courses ) }}) </span>
                        </a>
                   @if(count($section->childes) > 0)
                           @foreach( $section->childes as $child)
                            <a href="{{route('coursati.subcategory',[$section->id,make_slug($section->name)])}}" class="item">
                                {{$section->name}}  <span style="margin-left: 5px; margin-right: 5px"> ({{ count( $section->courses ) }}) </span>
                            </a>
                           @endforeach
                    @endif
                @endforeach
                @endif
            </div>
            @if(count($courses) > 0)
            <div class="topResult d-flex justify-content-between align-items-center mt-20">
                <div class="resultsNum">
                    <h4>{{__('web.All courses in Development')}} {{$category->name}}</h4>
                    <p>{{__('web.All course available')}}, {{count($category->courses)}} {{__('web.courses')}}</p>
                </div>

                <div class="filterBtns d-flex justify-content-center align-items-center">
                    <a class="listMenu d-none d-lg-flex" href="">
                        <img src="{{setAsset('website/img/gray_grid.svg')}}" alt="list">
                    </a>
                    <a class="gridMenu d-none d-lg-flex" href="">
                        <img src="{{setAsset('website/img/black_menu.svg')}}" alt="grid list">
                    </a>
                    <select class="selectpicker" id="rating" title="{{__('web.Rating')}}">
                        <option value="0">{{__('web.not_rated')}}</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="resultsContainer d-flex justify-content-between mt-0">
                <div class="results ml-0 w-100">
                    <div class="institutesContainer pt-0">
                        <div class="institutes" id="course-container">
                            @foreach($courses as $course)
                                @include('website.components.horizontalCourse')
                            @endforeach
                        </div>
                        <div class="bottomNav">
                            {{ $courses->links('pagination.default') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
            @include('website.components.empty')
        @endif
    </div>
    <!--end light gray bg-->
    @include('website.layouts.partial.popularInstructor')
    @include('website.layouts.partial.footerDetails')
@endsection

@push('scripts')
    @include('website.js.category')
@endpush