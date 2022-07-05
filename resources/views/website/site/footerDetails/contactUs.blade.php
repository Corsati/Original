@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <!--start light gray bg-->
    <div class="lightGrayBg">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('coursati.index')}}"><i class='fas fa-chevron-left'></i>{{__('web.Home')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('web.Contact-us')}}</li>
                </ol>
            </nav>
            <h2 class="title">{{__('web.Contact-us')}}</h2>
            <p class="desc">{{__('web.Contact-us-text')}}</p>
            <div class="cartContainer d-flex justify-content-between">
                <div class="payment accDetails mt-0">
                    <h3 class="title">{{__('web.Send-a-message')}}</h3>
                    <form action="{{route('coursati.contactUsSend')}}" class="ajaxContactSubmit" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="fullName">{{__('web.Full-name')}}</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" id="fullName" placeholder="{{__('web.Full-name')}}">
                        </div>
                        <div class="form-group">
                            <label for="emailAdd">{{__('web.Email')}}</label>
                            <input type="email" class="form-control" name="email" value="{{old('email')}}" id="emailAdd" placeholder="{{__('web.Email')}}">
                        </div>

                        <div class="rowSpace">
                            <div class="form-group">
                                <label for="number">{{__('web.Phone number')}}</label>
                                <input type="tel" class="form-control"  minlength="10" name="phone" value="{{old('phone')}}" id="number" placeholder="{{__('web.Phone number')}}">
                            </div>
                            <div class="form-group contactType">
                                <label for="type">{{__('web.Type of message')}}</label>
                                <select class="selectpicker w-100" id="type" name="contact_us_type_id" title="{{__('web.Select type')}}">
                                    @foreach($contactTypes as $contactType)
                                        <option value="{{$contactType->id}}">{{$contactType->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group textAreaDiv">
                                <label for="message">{{__('web.Message')}}</label>
                                <textarea class="form-control" id="message" name="message" rows="4" placeholder="{{__('web.Message')}}"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="orangeBtn" >{{__('web.Send message')}}</button>
                    </form>
                </div>
                <div class="cartItems advertiseLinks">
                    <h3 class="title">{{__('web.Social-media-links')}}</h3>
                    <div class="itemsCont">
                        <a href="{{strip_tags($data['facebook'])}}" target="_blank" class="socLinks">
                            <div>
                                <img src="{{setAsset('website/img/orange_face.svg')}}" alt="facebook">
                            </div>
                            Coursati @ Facebook
                        </a>
                        <a href="{{strip_tags($data['twitter'])}}" target="_blank" class="socLinks">
                            <div>
                                <img src="{{setAsset('website/img/orange_twitter.svg')}}" alt="twitter">
                            </div>
                            Coursati @ Twitter
                        </a>
                        <a href="{{strip_tags($data['youtube'])}}" target="_blank" class="socLinks">
                            <div>
                                <img src="{{setAsset('website/img/orange_youtube.svg')}}" alt="youtube">
                            </div>
                            Coursati @ Youtube
                        </a>
                        <a href="{{strip_tags($data['linkedin'])}}" target="_blank" class="socLinks">
                            <div>
                                <img src="{{setAsset('website/img/orange_linked.svg')}}" alt="facebook">
                            </div>
                            Coursati @ Linkedin
                        </a>
                        <a href="{{strip_tags($data['dribble'])}}" target="_blank" class="socLinks">
                            <div>
                                <img src="{{setAsset('website/img/orange_dribbble.svg')}}" alt="dribbble">
                            </div>
                            Coursati @ Dribble
                        </a>
                        <a href="{{strip_tags($data['behince'])}}" target="_blank" class="socLinks">
                            <div>
                                <img src="{{setAsset('website/img/orange_behance.svg')}}" alt="behance">
                            </div>
                            Coursati @ Behance
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end light gray bg-->
    @include('website.layouts.partial.footerDetails')
@endsection
