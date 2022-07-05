@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <!--start light gray bg-->
    <div class="lightGrayBg pb-5">
        <div class="container">
            <div class="catTitle">
                <img src="{{asset('website/img/c.png')}}" alt="c" style="margin: 5px">
                <h2 class="title">  {{__('web.all_categories')}}  </h2>
            </div>
            @foreach($main as $category)
                @if(count($category->childes) > 0)
            <div class="development">
                <img src="{{$category->icon}}" alt="book">
                <div class="d-flex flex-column justify-content-center">
                    <h2 class="title">
                        {{$category->getTranslation('name', lang())}}
                    </h2>
                    <p class="desc">
                        {{$category->getTranslation('description', lang())}}
                    </p>
                </div>
            </div>
                <div class="coursesContainer">
                @foreach($category->childes as $subcategory)
                        <a href="{{route('coursati.subcategory',[$subcategory->id,$subcategory->name])}}" class="item">
                            {{$subcategory->name}}  <span style="padding: 5px"> ({{ count($subcategory->courses) }}) </span>
                        </a>
                @endforeach
                </div>
                @endif
            @endforeach
        </div>
    </div>
    <!--end light gray bg-->
    @include('website.layouts.partial.footerDetails')
@endsection
