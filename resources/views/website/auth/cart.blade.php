@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <!--start light gray bg-->
    <div class="lightGrayBg">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('coursati.index')}}"><i class='fas fa-chevron-left'></i>{{__('web.My Dashboard')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('web.shopping cart')}}</li>
                </ol>
            </nav>
            <h2 class="title">{{__('web.shopping cart')}}</h2>
            <p class="desc">{{__('web.You can view')}}</p>
            <div class="cartContainer d-flex justify-content-between">
                <div class="payment">
                    {{-- <h3 class="title">{{__('web.Payment details')}}</h3>--}}
                    <form method="POST" action="{{route('coursati.completePurchase')}}">
                        @csrf
                        <!--
                        <div class="form-group">
                            <label for="fullName">{{__('web.name')}}</label>
                            <input type="text" class="form-control" id="fullName" placeholder="{{__('web.name')}}">
                        </div>
                        <div class="form-group">
                            <label for="emailAdd">{{__('web.email')}}</label>
                            <input type="email" class="form-control" id="emailAdd" placeholder="{{__('web.email')}}">
                        </div>
                        <div class="form-group">
                            <label for="country">{{__('web.country')}}</label>
                            <select class="selectpicker w-100" id="country" title="{{__('web.Select country')}}">
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Vat">{{__('web.Vat Number')}}</label>
                            <input type="text" disabled class="form-control" id="Vat" placeholder="{{__('web.Vat Number')}}">
                        </div>
                        <h3 class="title">{{__('web.Payment options')}}</h3>
                        <div class="PayOptions">
                            <img src="{{setAsset('website/img/visa.svg')}}" alt="visa">
                            <img src="{{setAsset('website/img/master.svg')}}" alt="master">
                            <img src="{{setAsset('website/img/discover.svg')}}" alt="discover">
                        </div>
                        <div class="form-group">
                            <label for="cardNum">{{__('web.Card number')}}</label>
                            <input type="password" class="form-control" id="cardNum" placeholder="xxxx - xxxx - xxx - xxxx - xxxx">
                        </div>
                        <div class="form-group">
                            <label for="cvcNum">{{__('web.CVC number')}}</label>
                            <input type="password" class="form-control" id="cvcNum" placeholder="XXX">
                        </div>
                        -->
                        @if(count(auth()->user()->cart) >0)
                                <div class="form-group">
                                    <span style="font-weight: bolder;font-size: 35px;">{{__('web.Total')}}</span>
                                    <span style="font-weight: bolder;font-size: 35px;" class="total">{{auth()->user()->cart()->sum('price')}}$</span>
                                </div>
                            <button type="submit" class="orangeBtn w-75" id="Checkout">{{__('web.Checkout')}}</button>
                        @endif
                    </form>
                </div>
                @if(count(auth()->user()->cart) > 0)
                <div class="cartItems">
                    <h3 class="title">{{__('web.Cart items')}}</h3>
                    <div class="itemsCont">
                        @foreach(auth()->user()->cart as $cart)
                        <div class="item d-flex cartItem">
                            <img src="{{$cart->course->image}}" data-src="{{$cart->course->image}}" alt="course">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="courseText">
                                    <h5>{{ \Illuminate\Support\Str::limit($cart->course->getTranslation('title',courseLng($cart->course)), 40, $end = '...') }}</h5>
                                    <p>{{$cart->course->user->first_name}} {{$cart->course->user->last_name}}</p>
                                    @if($cart->course->discount > 0)
                                        <div class="price"><sup>$</sup>{{discountCourse($cart->course->price,$cart->course->discount)}}<span><sup>$</sup>{{$cart->course->price}}</span></div>
                                    @else
                                        <div class="price"><sup>$</sup>{{ ( float) $cart->course->price}}</span></div>
                                    @endif                                </div>
                                    <a class="deleteItem" id="deleteItem" data-id="{{$cart->id}}">
                                        <i class="fas fa-times"></i>
                                    </a>
                            </div>
                        </div>
                        @endforeach
                        <hr class="customHr">
                        <div class="total d-flex justify-content-between align-items-center">
                            <span>{{__('web.Total')}}</span>
                            <span class="total">{{auth()->user()->cart()->sum('price')}}$</span>
                        </div>
                    </div>
                </div>

                @endif
            </div>
            @if(count(auth()->user()->cart) == 0)
                @include('website.components.empty')
            @endif
        </div>
    </div>
    @include('website.layouts.partial.footerDetails')
@endsection
@push('scripts')
    @include('website.js.cart')
@endpush
