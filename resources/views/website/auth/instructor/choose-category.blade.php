@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.headerDetails')
{{--    @include('website.layouts.partial.navbar')--}}
{{--    @include('website.auth.normalUser.login')--}}
    <div class="content w-78">
        <div class="lightGrayBg pb-4">
            <div class="container-sm container-md-none px-md-5 py-md-2 pr-120">
                <div class="topCat pt-2">
                    <h2 class="title">{{__('web.select_category')}}</h2>
                    <p class="desc">{{__('web.select-category-desc')}}</p>
                    <div class="categories">
                        @foreach($categories as $category)

                            <a href="{{route('coursati.createCourse',[ 'id' => $category->id , 'name' => seoUrl($category->name)])}}" class="cat d-inline-flex flex-column justify-content-center">
                                <img src="{{$category->icon}}" alt="{{$category->metadata}}">
                                <h4>{{$category->name}}</h4>
                                <div><span>{{count($category->courses)}}</span> {{__('web.courses-tutorials')}}</div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @include('website.layouts.partial.footerDashboard')
    </div>
    </div>
@endsection
