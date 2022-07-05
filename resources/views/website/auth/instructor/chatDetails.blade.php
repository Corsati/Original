@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.headerDetails')
    <style>
        .myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .myImg:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)}
            to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            z-index: 999;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
    </style>
    <div class="content w-78">
        <!--start light gray bg-->
        <div class="lightGrayBg myInboxCont pb-4">
            <div class="container-sm container-md-none px-md-5 py-md-2 pr-120">

                <div class="d-flex flex-row justify-content-between align-items-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('coursati.myInbox')}}"><i class='fas fa-chevron-left'></i>{{__('web.My inbox')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('coursati.courseDetails',['id' => $course->id , 'name' => make_slug($course->title)])}}" >{{$course->title}}</a></li>
                        </ol>
                    </nav>
                </div>

                @php
                    $currentRoom = $course->rooms->first();
                @endphp
                <div class="d-flex flex-row justify-content-between align-items-center mt-20 mb-3 flex-wrap">
                    <div class="">
                        <h2 class="title">{{__('web.My inbox')}}</h2>
                        <p class="desc">{{__('web.Select chat to start communicating')}}</p>
                    </div>
                    <a href="{{route('coursati.courseDetails',['id' => $course->id , 'name' => make_slug($course->title)  ])}}" class="blackText">{{__('web.View course page')}}</a>
                </div>

                <div class="d-block d-xl-flex flex-row justify-content-between courseContent flex-wrap w-100 ">

                    <div class="chatList studentFeedBack">
                        @foreach($course->rooms()->with('sender')->with('receiver')->with('course')->get() as $room)
                         <a href="#" onclick="refreshChat({{$room}})" class="media">
                            <img src="{{(auth()->user()->id == $room->sender->id ) ?  $room->receiver->avatar   : $room->sender->avatar }}" class="align-self-center mr-3" alt="profile">
                            <div class="media-body">
                                <div class="mb-1 d-flex flex-row align-items-center justify-content-between">
                                    <h5>{{(auth()->user()->id == $room->sender->id ) ?  $room->receiver->first_name   : $room->sender->first_name }}</h5>
                                    <span>{{$room->updated_at->diffForHumans()}}</span>
                                </div>
                                <div class="d-flex flex-row align-items-center justify-content-between">
                                    <p class="desc">{{$room->chat()->orderBy('id','DESC')->first()->message}}</p>

                                </div>
                            </div>
                        </a>
                        @endforeach


                    </div>

                    <div class="chatContainer">

                        <div class="chatHead">
                            <img id="headImage" src="{{(auth()->user()->id == $currentRoom->sender->id ) ?  $currentRoom->receiver->avatar   : $currentRoom->sender->avatar }}" class="align-self-center mr-3" alt="profile">
                            <span id="headName" >{{(auth()->user()->id == $currentRoom->sender->id ) ?  $currentRoom->receiver->first_name   : $currentRoom->sender->first_name }}</span>
                        </div>

                        <div class="chatBox" id="chatBox">
{{--                            <div class="mainDate">--}}
{{--                                <div class="line"></div>--}}
{{--                                <div class="date">10 Oct. 2020</div>--}}
{{--                            </div>--}}

                            @foreach($currentRoom->chat as $conversation)
                                <div class="{{$conversation->s_id == auth()->id() ? 'rightCont' : 'leftCont' }}">
                                    <div class="rightText">
                                        @if($conversation->type == 'text')
                                            {{$conversation->message}}
                                        @elseif($conversation->type == 'image')
                                            <img height="100" width="110" class="myImg" src="{{setUrl('storage/images/chat/',$conversation->message)}}">
                                        @elseif($conversation->type == 'video')
                                            <video width="320" height="240" controls>
                                                <source src="{{setUrl('storage/images/chat/',$conversation->message)}}" type="video/mp4">
                                                <source src="{{setUrl('storage/images/chat/',$conversation->message)}}" type="video/ogg">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <a href="{{setUrl('storage/images/chat/',$conversation->message)}}" target="_blank">
                                                <img height="100" width="110"   src="{{setAsset('website/img/file.png')}}">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="time">
                                        <i class="fas fa-check-double"></i>
                                        {{$conversation->created_at->diffForHumans()}}
                                    </div>
                                </div>
                                @php
                                    $conversation->update(['seen' => 1])
                                @endphp
                            @endforeach

                        </div>
                        <div class="chatFooter">
                            <form action="{{route('coursati.sendChatMessage')}}" class="ajaxSendMessage" method="post">
                                @csrf
                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                <input type="hidden"  id="room" name="room" value="{{$currentRoom->id}}">

                                <div class="form-group fake-input">
                                    <input  id="message" name="message" value="" type="text" class="form-control"   placeholder="{{__('web.Type here')}}">
                                    <img id="chatImageMessage" src="https://findicons.com/files/icons/2813/flat_jewels/512/file.png" width="70"/>
                                </div>
                                <button type="submit" id="send"   class="orangeBtn">{{__('web.send')}}</button>
                                <div class="form-group paperClip">
                                    <input id="photo-upload" name="file" class="uploadFile"  type="file">
                                    <a class=""><i class="fas fa-paperclip"></i></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal">
            <span id="close"  class="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>
        <!--end light gray bg-->
@include('website.layouts.partial.footerDashboard')
</div>
</div>
@endsection
@push('scripts')
    @include('website.js.chatDetails')
@endpush
