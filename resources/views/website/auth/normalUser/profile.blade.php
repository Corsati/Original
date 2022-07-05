@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
                <div class="lightGrayBg pb-5 profileScreen">
                    <div class="container">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('coursati.home')}}"><i class='fas fa-chevron-left'></i>{{__('web.Home')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('web.My profile')}}</li>
                            </ol>
                        </nav>
                        <h2 class="title">{{__('web.My profile')}}</h2>
                        <p class="desc">{{__('web.You can view and change your account details here')}}</p>
                        <div class="accDetails recommended mt-0">
                            <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-settings-tab" data-toggle="pill" href="#pills-settings" role="tab" aria-controls="pills-settings" aria-selected="true">{{__('web.public settings')}}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-password-tab" data-toggle="pill" href="#pills-password" role="tab" aria-controls="pills-password" aria-selected="false">{{__('web.update password')}}</a>
                                </li>
                                @if(auth()->user()->user_type === 3)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-payment-tab" data-toggle="pill" href="#pills-payment" role="tab" aria-controls="pills-payment" aria-selected="false">{{__('web.payment information')}}</a>
                                </li>
                                @endif
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-settings" role="tabpanel" aria-labelledby="pills-settings-tab">
                                    <form action="{{route('coursati.edit-profile',Auth::id())}}" class="flex-column ajaxProfileSubmit" method="post">
                                        @csrf
                                        <div class="d-flex justify-content-center flex-column">
                                            <div class="changeImg">
                                                <img src="{{auth()->user()->avatar}}" alt="profile">
                                                <a class="change">
                                                    {{__('web.Change image')}}
                                                    <input class="file-upload" type="file" name="avatar" accept="image/*"/>
                                                </a>
                                            </div>
                                            <div class="accId">{{__('web.account_id')}} :  {{auth()->user()->uuid}}</div>
                                        </div>
                                        <div class="rowSpace">
                                            <div class="form-group">
                                                <label for="firstName">{{__('web.first_name')}}</label>
                                                <input type="text" class="form-control" name="first_name" value="{{auth()->user()->first_name}}" id="firstName" placeholder="{{__('web.first_name')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="lastName">{{__('web.last_name')}}</label>
                                                <input type="text" class="form-control" name="last_name" value="{{auth()->user()->last_name}}" id="lastName" placeholder="{{__('web.last_name')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="emailAdd">{{__('web.email_address')}}</label>
                                                <input type="email" class="form-control" name="email" id="emailAdd" value="{{auth()->user()->email}}" placeholder="{{__('web.email_address')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">{{__('web.phone_number')}}</label>
                                                <input type="number" class="form-control" name="phone" id="phone" value="{{auth()->user()->phone}}" placeholder="{{__('web.phone_number')}}">
                                            </div>
                                            <div class="form-group countryForm" >
                                                <label for="" class="d-block">{{__('web.select_country')}}</label>
                                                <select class="selectpicker w-100" name="country_id" id="country_id" >
                                                    @foreach($countries as $country)
                                                        <option {{auth()->user()->country_id == $country->id ? 'selected' :''}} value="{{$country->id}}">{{$country->getTranslation('name', lang())}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group countryForm">
                                                <label for="" class="d-block">{{__('web.select_city')}}</label>
                                                <select  class="selectpicker w-100"  name="city_id" id="cityID"  >
                                                    <option value=""  hidden>{{__('web.select_city')}}</option>
                                                    @foreach($cities as $city)
                                                        <option value="{{$city->id}}"   {{auth()->user()->city_id == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group categoryForm imp-width" >
                                                    <label for="fields">{{__('web.interested_fields')}}</label>
                                                    <select class="selectpicker w-100 category" id="fields" name="category_id[]" multiple  title="{{__('web.select_category')}}">
                                                        @foreach($mainCategories as $category)
                                                            <option value="{{$category->id}}">{{$category->getTranslation('name', lang())}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <div class="titles imp-width">
                                                @foreach( auth()->user()->categories as $category)
                                                    <div id="div1">
                                                        <option value="{{$category->id}}">{{$category->getTranslation('name', lang())}}</option>
                                                        <a  class="deleteCategory deleteTitle" data-id="{{ $category->id }}" data-token="{{ csrf_token() }}">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="form-group imp-width">
                                                <label for="about">{{__('web.about')}}</label>
                                                <textarea  class="form-control" name="about"  cols="40" rows="30" id="about" placeholder="{{__('web.about')}}">{{auth()->user()->about}}</textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="orangeBtn">{{__('web.save_changes')}}</button>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab">
                                    <form action="{{route('coursati.edit-password',Auth::id())}}" class="flex-column EditPasswordSubmit" method="post">
                                        @csrf
                                        <div class="rowSpace">
                                            <div class="form-group imp-width" >
                                                <label for="phone">{{__('web.old_password')}}</label>
                                                <input type="password" class="form-control" required  name="old_password" id="old_password" placeholder="{{__('web.old_password')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">{{__('web.password')}}</label>
                                                <input type="password" class="form-control" required minlength="6" name="password" id="password" placeholder="{{__('web.password')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">{{__('web.pass_confirm')}}</label>
                                                <input type="password" class="form-control" required minlength="6"  name="password_confirmation" id="confirmPass" placeholder="{{__('web.pass_confirm')}}">
                                            </div>
                                        </div>
                                        <button type="submit" class="orangeBtn">{{__('web.save_changes')}}</button>
                                    </form>
                                </div>
                                @if(auth()->user()->user_type === 3)
                                <div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">
                                    <form action="{{route('coursati.edit-profile',Auth::id())}}" class="flex-column ajaxProfileSubmit" method="post">
                                        @csrf
                                        <div class="rowSpace">
                                            <div class="form-group">
                                                <label for="">{{__('web.bank_name')}}</label>
                                                <input type="text" class="form-control" name="bank_name" value="{{auth()->user()->instructor->bank_name}}"
                                                       id="bankName" placeholder="{{__('web.bank_name')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">{{__('web.iban_number')}}</label>
                                                <input type="text" class="form-control" name="iban_number" value="{{auth()->user()->instructor->iban_number}}"
                                                       id="ibanNum" placeholder="{{__('web.iban_number')}}">
                                            </div>
                                        </div>
                                        <button type="submit" class="orangeBtn">{{__('web.save_changes')}}</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
    @include('website.layouts.partial.footerDetails')
@endsection

