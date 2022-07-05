@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.headerDetails')

    <div class="content w-78">
        <!--start light gray bg-->
        <div class="lightGrayBg myInboxCont mainInbox pb-4">
            <div class="container-sm container-md-none px-md-5 py-md-2 pr-120">

                <div class="d-flex flex-row justify-content-between align-items-center mt-20 mb-3 flex-wrap">
                    <div class="">
                        <h2 class="title">{{__('web.My inbox')}}</h2>
                        <p class="desc">{{__('web.Select chat to start communicating')}}</p>
                    </div>
                </div>

                <div class="chatBlocks d-flex  flex-wrap">
                    @foreach($courses as $course)
                     <a href="{{route('coursati.chatDetails',['id' => $course->id])}}" class="course" style="margin: .5em;width: 100%;">
                        <div class="imgBlock">
                            <img src="{{$course->image}}" alt="course image">
                        </div>
                        <div class="px-3 pt-3">
                            <p class="courseName">{{$course->title}}</p>
                            <p class="chatNum">{{count($course->rooms)}} {{__('web.chat')}} ( <span>{{$course->rooms()->whereDate('created_at', \Carbon\Carbon::today())->count()}} {{__('web.new')}}</span> )</p>
                        </div>
                        <div class="chatUsers p-3">
                            @foreach($course->rooms as $room)
                            <img src="{{$room->receiver->avatar}}" alt="user">
                            @endforeach

                        </div>
                    </a>
                    @endforeach

                </div>
            </div>
        </div>
        <!--end light gray bg-->
@include('website.layouts.partial.footerDashboard')
</div>
</div>
@endsection
