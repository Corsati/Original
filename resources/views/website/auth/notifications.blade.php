@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <!--start light gray bg-->
    <div class="lightGrayBg">
        <div class="container">
            <h2 class="title">{{__('web.Notifications')}}</h2>
            <div class="notiUl w-100 mt-20">
                <ul>
                    @foreach(auth()->user()->notifications as $notification)
                        <li class="d-flex flex-row justify-content-between flex-wrap">
                            @if($notification->data['type'] == 'course')
                                <p style="display: flex">
                                    {{$notification->data['body']}} " 
                                    <a href="{{route('coursati.courseDetails',['id' => $notification->data['course_id'] , 'name' => make_slug(findCourseName($notification->data['course_id']))])}}">
                                        <span>{{findCourseName($notification->data['course_id'])}}</span>
                                    </a> 
                                    "!
                                </p>
                            @elseif($notification->data['type'] == 'chat')
                                @if(auth()->user()->user_type == 3 )
                                <a href="{{route('coursati.chatDetails',['id' => $notification->data['course_id']])}}">
                                    {{$notification->data['body']}} <span>{{findCourseName($notification->data['course_id'])}}</span>
                                </a>
                                @else
                                    <p style="display: flex">
                                        {{$notification->data['body']}} "
                                        <a href="{{route('coursati.courseDetails',['id' => $notification->data['course_id'] , 'name' => make_slug(findCourseName($notification->data['course_id']))])}}">
                                            <span>{{findCourseName($notification->data['course_id'])}}</span>
                                        </a>
                                        "!
                                    </p>
                                @endif
                            @else
                                <p>{{$notification->data['body']}}</p>
                            @endif

                            <span>{{$notification->created_at->diffForHumans()}}</span>
                        </li>
                        @php
                            if(!empty($notification)){
                                $notification->markAsRead();
                            }
                        @endphp
                    @endforeach
                </ul>
                @if(count(auth()->user()->notifications) == 0)
                    @include('website.components.empty')
                @endif
            </div>
        </div>
    </div>
    <!--end light gray bg-->
    @include('website.layouts.partial.footerDetails')
@endsection
