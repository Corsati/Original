@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.headerDetails')

    <div class="content w-78">
        <!--start light gray bg-->
        <div class="lightGrayBg pb-4">
            <div class="container-sm container-md-none px-md-5 py-md-2 pr-120">
                <div class="performance mt-30">
                    <h2 class="title">{{__('web.Performance')}}</h2>
                    <p class="desc">{{__('web.Know your activity and how your courses react with students')}}</p>
                    <div class="coursesContainer mt-4">
                        @foreach($categories as $category)
                        <a href="{{route('coursati.courses')}}" class="item">
                            <img src="{{$category->icon}}" alt="category">
                            <div>
                                <h4>{{$category->name}}</h4>
                                <span>{{count($category->courses)}}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <!--start have ques-->
                <div class="haveQues mt-5">
                    <h2 class="title">{{__('web.contact')}}</h2>
                    <a href="contactUs.html" class="orangeBtn">{{__('web.Contact us')}}</a>
                </div>
                <!--end have ques-->
            </div>
        </div>
        <!--end light gray bg-->
@include('website.layouts.partial.footerDashboard')
</div>
</div>
@endsection
