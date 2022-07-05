@extends('admin.layout.master')
@section('content')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <section class="content sectionFor">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="  p-2">
                            <div class="tab-content">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="{{$object->avatar}}"
                                             alt="User profile picture">
                                    </div>
                                    <h3 class="profile-username text-center">{{$object->first_name}} {{$object->last_name}}</h3>
                                    <p class="text-muted text-center">{{__('student')}}</p>
                                    <h3 class="profile-username text-center"># {{$object->id}}</h3>
                                    <ul class="list-group list-group-unbordered mb-3">

                                        <li class="list-group-item">
                                            <a class="float-left    padding-5 white">{{$object->userCourses->count()}}</a>
                                            <b>{{__('courses_count')}}</b>
                                        </li>
                                        <li class="list-group-item">
                                            <a class="float-left  padding-5">{{$object->orders->count()}}</a><b>{{__('orders_count')}}</b>
                                        </li>
                                        <li class="list-group-item">
                                            <a class="float-left  padding-5">{{$object->favourites->count()}}</a><b>{{__('favourites')}}</b>
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
                            <ul class="nav nav-pills" style="justify-content: space-around;">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                                        data-toggle="tab">{{__('edit_info')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#courses"
                                                        data-toggle="tab">{{__('courses')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#favourites"
                                                        data-toggle="tab">{{__('favourite')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#transactions"
                                                        data-toggle="tab">{{__('transactions')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#orders"
                                                        data-toggle="tab">{{__('orders')}}</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div>
                                        <form action="{{route('admin.users.update',$object->id)}}" method="post"
                                              role="form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{$object->id}}" name="id">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>{{__('first_name')}}</label>
                                                            <input required type="text" name="first_name"
                                                                   value="{{$object->first_name}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>{{__('last_name')}}</label>
                                                            <input required type="text" name="last_name"
                                                                   value="{{$object->last_name}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>{{__('phone')}}</label>
                                                            <input required type="number" name="phone"
                                                                   value="{{$object->phone}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>{{__('email')}}</label>
                                                            <input required type="email" name="email"
                                                                   value="{{$object->email}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>{{__('country')}}</label>
                                                            <select name="country_id" class="form-control" id="country"
                                                                    required>
                                                                <option value="" selected
                                                                        hidden>{{__('choose_country')}}</option>
                                                                @foreach($countries as $country)
                                                                    <option
                                                                        {{$object->country_id == $country->id ? 'selected' :''}} value="{{$country->id}}">{{$country->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>{{__('city')}}</label>
                                                            <select name="city_id" class="form-control city" required>
                                                                <option value="" selected
                                                                        hidden>{{__('choose_city')}}</option>
                                                                @foreach($cities as $city)
                                                                    <option
                                                                            {{$object->city_id == $city->id ? 'selected' :''}} value="{{$city->id}}">{{$city->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="submit" class="btn btn-primary">{{__('save')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="favourites">
                                    <div class="card page-body">
                                        <div class="table-responsive">
                                            <table id="datatable-table"
                                                   class="table table-striped table-bordered dt-responsive nowrap"
                                                   style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>{{__('title')}}</th>
                                                    <th>{{__('category')}}</th>
                                                     <th>{{__('instructor')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($object->favourites as $ob)
                                                    <tr>
                                                        <td>{{$ob->course->title}}</td>
                                                        <td><p
                                                             >{{$ob->course->category->name}}</p>
                                                        </td>
                                                        <td><a href="{{route('admin.instructors.profile',$ob->course->user->id)}}">{{$ob->course->user->first_name}} {{$ob->course->user->last_name}}</a></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

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
                                                    <th>{{__('category')}}</th>
                                                    <th>{{__('instructor')}}</th>
                                                    <th>{{__('duration')}}</th>
                                                    <th>{{__('purchase_date')}}</th>
                                                    <th>{{__('price')}}</th>
                                                    <th>{{__('rate')}}</th>
                                                    <th>{{__('status')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($courses as $ob)
                                                    <tr>
                                                        <td>{{$ob->course->title}}</td>
                                                        <td>{{$ob->course->category->name}}</td>
                                                        <td><a href="{{route('admin.instructors.profile',$ob->course->user->id)}}">{{$ob->course->user->first_name}} {{$ob->course->user->last_name}}</a></td>
                                                        <td>{{$ob->course->total_hours}}  {{__('hours')}}</td>
                                                        <td>{{$ob->created_at}}</td>
                                                        <td>00 $</td>
                                                        <td>00 *</td>
                                                        <td>{{$ob->status}}</td>
                                                     </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="transactions">
                                   <p style="text-align: center; font-size: 25px"> {{__('web.soon')}} </p>
                                </div>
                                <div class="tab-pane" id="orders">
                                    <p style="text-align: center; font-size: 25px"> {{__('web.soon')}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script src="{{asset('dashboard/js/jquery.js')}}"></script>
@section('script')
    <script type="text/javascript">
        $('select#country,select#country_id').on('change', function (e) {
            $('.city').empty();
            var countryId = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{route('admin.countries.cities')}}",
                dataType: "json",
                data: {
                    'country_id': countryId,
                    '_token': '{{csrf_token()}}'
                },
                success: function (data) {
                    console.log(data)
                    $.each(data, function (i, d) {
                        $('.city').append('<option value="' + d.id + '">' + d.name.ar + '</option>');
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(function () {
            initHijrDatePicker();
            initHijrDatePickerDefault();
            $('.disable-date').hijriDatePicker({
                minDate:"2020-01-01",
                maxDate:"2021-01-01",
                viewMode:"years",
                hijri:true,
                debug:true
            });
        });
        function initHijrDatePicker() {
            $(".hijri-date-input").hijriDatePicker({
                locale: "ar-sa",
                format: "DD-MM-YYYY",
                hijriFormat:"iYYYY-iMM-iDD",
                dayViewHeaderFormat: "MMMM YYYY",
                hijriDayViewHeaderFormat: "iMMMM iYYYY",
                showSwitcher: true,
                allowInputToggle: true,
                showTodayButton: false,
                useCurrent: true,
                isRTL: false,
                viewMode:'months',
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

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
    <script>
        try {
            fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
                return true;
            }).catch(function(e) {
                var carbonScript = document.createElement("script");
                carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
                carbonScript.id = "_carbonads_js";
                document.getElementById("carbon-block").appendChild(carbonScript);
            });
        } catch (error) {
            console.log(error);
        }
    </script>
@endsection
