@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <div class="lightGrayBg pb-5">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('coursati.index')}}"><i
                                    class='fas fa-chevron-left'></i>{{__('web.home')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('web.teach_with_us')}}</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="title">{{__('web.teach_with_us')}}</h2>
                    <p class="desc">{{__('web.confirm_msg')}}</p>
                </div>
                <div class="steps d-none d-md-flex">
                    <div class="circleBlock">
                        <span>{{__('web.account_details')}}</span>
                        <div class="orangeCircle">1</div>
                    </div>
                    <div class="circleBlock">
                        <span>{{__('web.qualifications')}}</span>
                        <div class="grayCircle">2</div>
                    </div>
                </div>
            </div>
            <div class="accDetails">
                <h3 class="title mb-3">
                    {{__('web.account_details')}}
                </h3>
                <form action="{{route('coursati.upgradeTechCoursati')}}" class="ajaxUpgradeSubmit" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_type" value="3">
                    <div class="changeImg">
                        <img src="{{auth()->user()->avatar}}" alt="profile">
                        <a class="change">
                            {{__('web.change_image')}}
                            <input class="file-upload" type="file" name="avatar" accept="image/*"/>
                        </a>
                    </div>
                    <div class="rowSpace">
                        <div class="form-group">
                            <label for="firstName">{{__('web.first_name')}} <span class="required-span">*</span></label>
                            <input type="text" class="form-control" name="first_name"
                                   value="{{auth()->user()->first_name}}" id="firstName"
                                   placeholder="{{__('web.first_name')}}">
                        </div>
                        <div class="form-group">
                            <label for="lastName">{{__('web.last_name')}} <span class="required-span">*</span></label>
                            <input type="text" class="form-control" name="last_name"
                                   value="{{auth()->user()->last_name}}" id="lastName"
                                   placeholder="{{__('web.last_name')}}">
                        </div>
                        <div class="form-group">
                            <label for="dob">{{__('web.birth_date')}} <span class="required-span">*</span></label>
                            <input type="text" class="form-control  hijri-date-input" name="birth_date"  autocomplete="off"
                                   id="hijri-date-input" placeholder="{{__('web.birth_date')}}">
                        </div>
                        <div class="form-group genderForm">
                            <label for="gender" class="d-block">{{__('web.gender')}}</label>
                            <select class="selectpicker w-100" name="gender" id="gender" title="{{__('web.select')}}">
                                <option value="male">{{__('web.male')}}</option>
                                <option value="female">{{__('web.female')}}</option>
                            </select>
                        </div>
                        <div class="form-group nationalityForm">
                            <label for="nationality" class="d-block">{{__('web.nationality')}} <span class="required-span">*</span></label>
                            <select class="selectpicker w-100" name="nationality" id="nationality"
                                    title="{{__('web.select')}}">
                                @foreach($nationalities as $nationality)
                                    <option value="{{$nationality->id}}">{{$nationality->getTranslation('name', lang())}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group langForm">
                            <label for="language" class="d-block">{{__('web.choose-language')}} <span class="required-span">*</span></label>
                            <select class="selectpicker w-100" multiple name="language" id="language"
                                    title="{{__('web.select')}}">
                                <option value="ar">{{__('web.ar')}}</option>
                                <option value="en">{{__('web.en')}}</option>
                            </select>
                        </div>
                        <div class="form-group countryForm">
                            <label for="country">{{__('web.country')}} <span class="required-span">*</span></label>
                            <select class="selectpicker w-100" name="country_id" id="country">
                                <option value="" selected hidden>{{__('web.country')}}</option>
                                @foreach($countries as $country)
                                    <option {{auth()->user()->country_id == $country->id ? 'selected' :''}} value="{{$country->id}}">{{$country->getTranslation('name', lang())}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group cityForm">
                            <label for="" class="d-block">{{__('web.select_city')}} </label>
                            <select class="selectpicker w-100" name="city_id" id="citiesId">
                                <option value="" hidden>{{__('web.select_city')}}</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{auth()->user()->city_id == $city->id ? 'selected' : ''}} >{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group textAreaDiv">
                            <label for="photo-upload" class="custom-file-upload">{{__('web.identification_img')}} <span
                                        class="required-span">* </span> </label>
                            <input type="text" class="form-control docPhoto"  placeholder="Browse" disabled>

                            <input class="photo-upload uploadFile" name='identification_img' type="file"
                                   accept="image/jpg, image/jpeg ,image/png">
                        </div>
                        <div class="form-group textAreaDiv">
                            <label for="bio">{{__('web.about')}} <span class="required-span">*</span></label>
                            <textarea class="form-control" id="bio" name="bio" rows="5"
                                      placeholder="{{__('web.about')}}"></textarea>
                        </div>
                        <div class="form-group textAreaDiv ">
                            <label for="fields">{{__('web.interested_fields')}} <span class="required-span">*</span></label>
                            <select class="selectpicker w-100 category" id="fields" name="category_id[]" multiple
                                   title="{{__('web.select_category')}}" data-live-search="true">
                                @foreach($main as $category)
                                    <option value="{{$category->id}}">{{$category->getTranslation('name', lang())}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group textAreaDiv ">
                            <div class="titles">
                                @foreach( auth()->user()->categories as $category)
                                    <div id="div1">
                                        <option value="{{$category->id}}">{{$category->getTranslation('name', lang())}}</option>
                                        <a class="deleteCategory deleteTitle" data-id="{{ $category->id }}"
                                           data-token="{{ csrf_token() }}">

                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="emailAdd">{{__('web.email_address')}} <span class="required-span">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{auth()->user()->email}}"
                                   id="emailAdd" placeholder="{{__('web.email_address')}}">
                        </div>
                        <div class="form-group">
                            <label for="phone">{{__('web.phone_number')}} <span class="required-span">*</span></label>
                            <input type="number" class="form-control" name="phone" value="{{auth()->user()->phone}}"
                                   id="phone" placeholder="{{__('web.phone_number')}}">
                        </div>
                    </div>
                    <button type="submit" class="orangeBtn" id="signUpModal">{{__('web.save_changes')}}</button>
                </form>
            </div>

        </div>
    </div>
    @include('website.layouts.partial.footerDetails')

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment-hijri@2.1.2/moment-hijri.min.js"></script>
    <script src="{{setAsset('dist/js/bootstrap-hijri-datetimepicker.js?v2')}}"></script>

    <script type="text/javascript">
        $('#identification_img').tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
        $('#identification_img').on('click', function () {
            $(this).tooltip('destroy');
        });
        window.onbeforeunload = function() { return "Your work will be lost."; };

        $(function () {
            $("#hijri-date-input").hijriDatePicker({
                maxDate  :'{{date('Y-m-d',strtotime("-1 days"))}}',
                showTodayButton: true,
                showClose: true,
                showClear: true,
                icons    : {
                    previous: '<',
                    next : '>',
                    clear: '{{__('web.delete')}}',
                    close: '{{__('web.close')}}'
                },
                hijriText: "{{__('web.showHijiri')}}",
                gregorianText: "{{__('web.showDate')}}"
            });
        });


    </script>
@endpush