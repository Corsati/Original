@extends('admin.layout.master')
@section('content')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <section class="content sectionFor">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class=" p-2">
                            <div class="tab-content">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="{{$object->avatar}}"
                                             alt="User profile picture">
                                    </div>
                                    <h3 class="profile-username text-center">{{$object->first_name}} {{$object->last_name}}</h3>
                                    <p class="text-muted text-center">{{__('instructor')}}</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <a class="float-left    padding-5 white">{{$object->courses()->count()}}</a>
                                            <b>{{__('courses_count')}}</b>
                                        </li>
                                        <li class="list-group-item">
                                            <a class="float-left  padding-5">0</a> <b>{{__('orders_count')}}</b>
                                        </li>
                                        <li class="list-group-item">
                                            <a class="float-left  padding-5">{{$object->comments->avg('rate')??0}}</a><b>{{__('rates_count')}}</b>
                                        </li>
                                        <li class="list-group-item">
                                            <a class="float-left  padding-5">{{strtoupper($object->instructor->language)}}</a><b>{{__('languages')}}</b>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills" style="justify-content: space-around">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                                        data-toggle="tab">{{__('edit_info')}}</a></li>
                                <li class="nav-item"><a class="nav-link " href="#tutor"
                                                        data-toggle="tab">{{__('job_description')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#qualifications"
                                                        data-toggle="tab">{{__('academy')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#teaching_categories"
                                                        data-toggle="tab">{{__('Teaching_Categories')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#identity_img"
                                                        data-toggle="tab">{{__('identity_img')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bank"
                                                        data-toggle="tab">{{__('bank')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#courses"
                                                        data-toggle="tab">{{__('courses')}}</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div>
                                        <form action="{{route('admin.instructors.upgradeToInstructor')}}" method="post"
                                              role="form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{$object->id}}" name="id">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div>
                                                        <div class="row" style="border: .5px solid #bbb; padding: 20px">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>{{__('first_name')}}</label>
                                                                    <input required type="text" name="first_name"
                                                                           value="{{$object->first_name}}"
                                                                           class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>{{__('last_name')}}</label>
                                                                    <input required type="text" name="last_name"
                                                                           value="{{$object->last_name}}"
                                                                           class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>{{__('birth_date')}}</label>
                                                                    <input type="text" name="birth_date"
                                                                           value="{{$object->birth_date}}"
                                                                           placeholder="{{$object->birth_date}}"
                                                                           class="form-control hijri-date-input">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>{{__('gender')}}</label>
                                                                    <select name="gender" class="form-control" required>
                                                                        <option value="" selected
                                                                                hidden>{{__('choose_gender')}}</option>

                                                                        <option {{$object->instructor->gender == 'male'    ? 'selected' :''}} value="male">{{__('male')}}</option>
                                                                        <option {{$object->instructor->gender == 'female'  ? 'selected' :''}} value="female">{{__('female')}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="nationality"
                                                                       class="d-block">{{__('web.nationality')}} <span
                                                                            class="required-span">*</span></label>
                                                                <select class="form-control" name="nationality"
                                                                        id="nationality"
                                                                        title="{{__('web.select')}}">
                                                                    @foreach($nationalities as $nationality)
                                                                        <option {{$object->instructor->nationality == $nationality->id  ? 'selected' :''}} value="{{$nationality->id}}">{{$nationality->getTranslation('name', lang())}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="nationality"
                                                                       class="d-block">{{__('web.language')}} <span
                                                                            class="required-span">*</span></label>
                                                                <select class="form-control" name="language"
                                                                        id="language" title="{{__('web.select')}}">
                                                                    <option {{$object->instructor->language == 'ar'  ? 'selected' :''}} value="ar">{{__('web.ar')}}</option>
                                                                    <option {{$object->instructor->language == 'en'  ? 'selected' :''}} value="en">{{__('web.en')}}</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="country_id"
                                                                       class="d-block">{{__('web.select_country')}} <span
                                                                            class="required-span">*</span></label>
                                                                <select class="form-control" name="country_id"
                                                                        id="country_id" title="{{__('web.select_country')}}">
                                                                    @foreach($countries as $country)
                                                                        <option {{$country->country_id == $country->id ? 'selected' :''}} value="{{$country->id}}">{{$country->getTranslation('name', lang())}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>{{__('city')}}</label>
                                                                    <select id="city" name="city_id" class="form-control city"
                                                                            required>
                                                                        <option value="" selected
                                                                                hidden>{{__('choose_city')}}</option>
                                                                        @foreach($cities as $city)
                                                                            <option
                                                                                    {{$object->city_id == $city->id ? 'selected' :''}} value="{{$city->id}}">{{$city->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>{{__('phone')}}</label>
                                                                    <input required type="number" minlength="10"
                                                                           name="phone" value="{{$object->phone}}"
                                                                           class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>{{__('email')}}</label>
                                                                    <input required type="email" name="email"
                                                                           value="{{$object->email}}"
                                                                           class="form-control">
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>{{__('Identification_photo')}} </label>
                                                                    <input type="file" name="identification_img"
                                                                           class="form-control" id="image"
                                                                           accept="image/*">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>{{__('bio')}}</label>
                                                                    <textarea required class="form-control"
                                                                              cols="50"
                                                                              name="bio">{{$object->instructor->bio}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{__('save')}}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="tab-pane" id="bank">
                                    <div>
                                        <form action="{{route('admin.instructors.upgradeToInstructor')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$object->id}}" name="id">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div>
                                                        <div class="row" style=" padding: 20px">
                                                            <div class="col-sm-12">
                                                                <div class="flex flexSpace">
                                                                    <h4 style="margin-top: 15px;margin-bottom: 15px">{{__('bank')}}</h4>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>{{__('bank_name')}}</label>
                                                                    <input type="text" name="bank_name"
                                                                           value="{{$object->instructor->bank_name}}"
                                                                           class="form-control  ">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>{{__('iban_number')}}</label>
                                                                    <input type="text" name="iban_number"
                                                                           value="{{$object->instructor->iban_number}}"
                                                                           minlength="10" class="form-control ">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{__('save')}}</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                                <div class=" tab-pane" id="tutor">
                                    <div>
                                        <form action="{{route('admin.instructors.upgradeToInstructor')}}" method="post"
                                              role="form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{$object->id}}" name="id">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="row" id="academy_container" style="width: 100%">
                                                        <div class="col-sm-12">
                                                            <div class="flex flexSpace clickBtn">
                                                                <h4 style="margin-top: 15px;margin-bottom: 15px">{{__('academy')}}</h4>
                                                                <div id="more-academy">
                                                                    <i class="fas fa-plus"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input type="text" name="academy[1][title]"
                                                                       placeholder="{{__('title')}}"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input type="text" name="academy[1][details]"
                                                                       placeholder="{{__('details')}}"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input type="file" placeholder="{{__('proof')}}"
                                                                       name="academy[1][proof_image]"
                                                                       class="form-control"
                                                                       id="image" accept="image/*">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row more_academy" style="width : 100%"></div>
                                                    <hr>
                                                    <br><br>
                                                    <div class="row" id="more_Teaching_Categories_container"
                                                         style="width: 100%">
                                                        <div class="col-sm-12">
                                                            <div class="flex flexSpace clickBtn">
                                                                <h4 style="margin-top: 15px;margin-bottom: 15px">{{__('Teaching_Categories')}}</h4>
                                                                <div id="more_Teaching_Categories">
                                                                    <i class="fas fa-plus"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <select name="experience[1][category_id]"
                                                                        class="form-control">
                                                                    <option value="" selected
                                                                            hidden>{{__('choose_category')}}</option>
                                                                    @foreach($categories as$category)
                                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input placeholder="{{__('Experience_years')}}"
                                                                       type="text"
                                                                       name="experience[1][experience_years]"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <select name="experience[1][experience_level]"
                                                                        class="form-control">
                                                                    <option value="">{{__('Level_of_Experience')}}</option>
                                                                    @foreach($academics as $academic)
                                                                        <option value="{{$academic->id}}">{{$academic->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <textarea {{__('about')}}  class="form-control"
                                                                          name="experience[1][description]"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row more_Teaching_Categories"
                                                             style="width : 100%"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{__('save')}}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="qualifications">
                                    <div class="table-responsive">
                                        <table id="datatable-table"
                                               class="table table-striped table-bordered dt-responsive nowrap"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{__('title')}}</th>
                                                <th>{{__('details')}}</th>
                                                <th>{{__('image')}}</th>
                                                <th>{{__('control')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($object->qualifications as $ob)
                                                <tr>
                                                    <td>{{$ob->title}}</td>
                                                    <td>{{$ob->details}}</td>
                                                    <td>
                                                        <a target="_blank" href="{{$ob->proof_image}}">
                                                            {{__('image')}}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="btn btn-danger"
                                                             onclick="confirmDelete('{{route('admin.qualifications.delete',$ob->id)}}')"
                                                             data-toggle="modal" data-target="#delete-model">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="teaching_categories">
                                    <div class="table-responsive">
                                        <table class="datatable-table table table-striped table-bordered dt-responsive nowrap"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{__('experience_years')}}</th>
                                                <th>{{__('experience_level')}}</th>
                                                <th>{{__('description')}}</th>
                                                <th>{{__('category')}}</th>
                                                <th>{{__('control')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($object->teaching_categories as $ob)
                                                <tr>
                                                    <td>{{$ob->experience_years}}</td>
                                                    <td>{{level_text($ob->experience_level)}}</td>
                                                    <td>{{$ob->description	}}</td>
                                                    <td>{{$ob->category->name}}</td>
                                                    <td>
                                                        <div class="btn btn-danger"
                                                             onclick="confirmDelete('{{route('admin.teaching_categories.delete',$ob->id)}}')"
                                                             data-toggle="modal" data-target="#delete-model">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="identity_img">
                                    <img src="{{$object->instructor->identification_img}}" width="300" href="200">
                                </div>
                                <div class="tab-pane" id="courses">
                                    <div class="card page-body">
                                        <div class="table-responsive">
                                            <table id="datatable-table"
                                                   class="table table-striped table-bordered dt-responsive nowrap"
                                                   style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>{{__('title')}}</th>
                                                    <th>{{__('price')}}</th>
                                                    <th>{{__('category')}}</th>
                                                    <th>{{__('discount')}}</th>
                                                    <th>{{__('views')}}</th>
                                                    <th>{{__('user')}}</th>
                                                    <th>{{__('change-status')}}</th>
                                                    <th>{{__('control')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($object->courses as $ob)
                                                    <tr>
                                                        <td>{{$ob->title}}</td>
                                                        <td>{{$ob->price}}</td>
                                                        <td>{{$ob->category->name}}</td>
                                                        <td>{{$ob->discount}}</td>
                                                        <td><p style="width: 100%"
                                                               class="btn btn-primary">{{$ob->userCourses->count()}}</p>
                                                        </td>
                                                        <td>{{$ob->user->first_name}} {{$ob->user->last_name}}</td>
                                                        <td>
                                                            <a href="{{route('admin.courses.changeStatus',$ob->id)}}">

                                                                @if($ob->status == 'pending')
                                                                    <p class="btn btn-warning">{{__('in_review')}}</p>
                                                                @elseif($ob->status == 'in_review')
                                                                    <p class="btn btn-success">{{__('activate')}}</p>
                                                                @else
                                                                    <p class="btn btn-info">{{__('pending')}}</p>
                                                                @endif
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-info"
                                                               href="{{route('admin.courses.display',$ob->id)}}">
                                                                <i class="fas fa-link"></i>
                                                            </a>
                                                            <button class="btn btn-danger"
                                                                    onclick="confirmDelete('{{route('admin.courses.delete',$ob->id)}}')"
                                                                    data-toggle="modal" data-target="#delete-model">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script src="{{setAsset('dashboard/js/jquery.js')}}"></script>
<script type="text/javascript">
    $(function () {
        initHijrDatePicker();
        initHijrDatePickerDefault();
        $('.disable-date').hijriDatePicker({
            minDate: "2020-01-01",
            maxDate: "2021-01-01",
            viewMode: "years",
            hijri: true,
            debug: true
        });
    });

    function initHijrDatePicker() {
        $(".hijri-date-input").hijriDatePicker({
            locale: "ar-sa",
            format: "DD-MM-YYYY",
            hijriFormat: "iYYYY-iMM-iDD",
            dayViewHeaderFormat: "MMMM YYYY",
            hijriDayViewHeaderFormat: "iMMMM iYYYY",
            showSwitcher: true,
            allowInputToggle: true,
            showTodayButton: false,
            useCurrent: true,
            isRTL: false,
            viewMode: 'months',
            keepOpen: false,
            hijri: false,
            debug: true,
            showClear: true,
            showTodayButton: true,
            showClose: true
        });
    }

    function initHijrDatePickerDefault() {

        $(".hijri-date-default").hijriDatePicker();
    }

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

</script>
<script>
    try {
        fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", {
            method: 'HEAD',
            mode: 'no-cors'
        })).then(function (response) {
            return true;
        }).catch(function (e) {
            var carbonScript = document.createElement("script");
            carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
            carbonScript.id = "_carbonads_js";
            document.getElementById("carbon-block").appendChild(carbonScript);
        });
    } catch (error) {
        console.log(error);
    }
</script>
@section('script')
    <script>
        let x = 2;
        $(document).on('click', '#more-academy', function () {
            var $body = $('.more_academy');
            var ajax = new XMLHttpRequest();
            ajax.open("GET", "{{url('admin-user-qualifications')}}" + '/' + x, false);
            ajax.send();
            $body.append(ajax.responseText);
            x++;
        });

        $(document).on('click', '#more_Teaching_Categories', function () {
            var $body = $('.more_Teaching_Categories');
            var ajax = new XMLHttpRequest();
            ajax.open("GET", "{{url('admin-user-teachings')}}" + '/' + x, false);
            ajax.send();
            $body.append(ajax.responseText);
            x++;
        });

        $(document).on('click', '.deleteBtn', function () {
            $(this).parent().closest('.row').remove();
        });

        $('select#country,select#country_id').on('change', function (e) {
            var $CITY           = $('#city');
            $CITY               .empty();
            var countryId       = $(this).val();
            $.ajax({
                type            : "POST",
                url             : "{{route('coursati.countries.cities')}}",
                dataType        : "json",
                data: {
                    'country_id': countryId,
                    '_token'    : '{{csrf_token()}}'
                },
                success         : function (data) {
                    $CITY       .html(data);
                }
            });
        });
    </script>

@endsection
