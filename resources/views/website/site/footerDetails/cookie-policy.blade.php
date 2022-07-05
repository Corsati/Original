@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <body class="pt-0">
    <div class="lightGrayBg pt-0">
        <div class="aboutBg">
            <div class="orangeBg">
                <div class="container">
                    <a href="{{route('coursati.index')}}" class="back">
                        <img src="{{asset('website/img/black_back.png')}}" alt="back">
                        {{__('web.Back to main website')}}
                    </a>
                    <img src="{{asset('website/img/c_circle.png')}}" alt="c" class="cCircle">
                    <img src="{{asset('website/img/logo1.png')}}" alt="c" class="logoWhite">
                    <p class="desc">{{strip_tags($data['description_'.lang()])}}</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="about">
                <h4 class="title">{{__('web.About Cookie')}}</h4>
                <p>{!! $data['cookie_policy_'.lang()] !!}</p>
            </div>
        </div>
    </div>
    </body>
    @include('website.layouts.partial.footerDetails')
@endsection
