@extends('admin.layout.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ">
                    <div class="page-header callout-primary d-flex justify-content-between">
                        <h2>{{__('users')}}</h2>
                        <div>
                            <button type="button" data-toggle="modal" data-target="#addModel"
                                    class="btn btn-primary btn-wide waves-effect waves-light">
                               </i> {{__('add_user')}}
                            </button>
                            <button type="button" data-toggle="modal" data-target="#messageAllModel"
                                    class="btn btn-info btn-wide waves-effect waves-light">
                                {{__('notify_all')}}
                            </button>
                        </div>
                    </div>
                    <div class="page-header callout-primary d-flex">

                        <div class="col-md-4">
                            <div class="stati turquoise left">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                <div>
                                    <b>{{$newUsers}}</b>
                                    <span>{{__('new_users')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stati turquoise left">
                                <i class="fa fa-list-ol" aria-hidden="true"></i>
                                <div>
                                    <b>{{count($objects)}}</b>
                                    <span>{{__('total_users')}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="stati turquoise left">
                                @if($thisWeek > $lastWeek)
                                    <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                @elseif($thisWeek == $lastWeek)
                                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                @endif
                                <div>
                                    @if($thisWeek > $lastWeek)
                                        <b>{{$thisWeek}}</b>
                                        <span>{{__('increase')}}</span>
                                    @elseif($thisWeek == $lastWeek)
                                        <b>{{$thisWeek}}</b>
                                        <span>{{__('same')}}</span>
                                    @else
                                        <b>{{$thisWeek - $lastWeek}}</b>
                                        <span>{{__('minus')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card page-body">
            <div class="row">
                <div class="form-group">
                    <select id='banned' class="form-control" style="width: 200px; margin-left: 10px;margin-right: 10px">
                        <option   value="">   فلتر الحالة </option>
                        <option value="فعال">فعال</option>
                        <option value="غير فعال">غير فعال</option>
                    </select>
                </div>
                <div class="form-group">
                    <select id='city' class="form-control" style="width: 200px;margin-left: 10px;margin-right: 10px">
                        <option   value="">   فلتر المدينة </option>
                        @foreach($cities as $city)
                            <option   value="{{$city->name}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <p class="table-responsive">
            <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"
                   style="width:100%">
                <thead>
                <tr>
                    <th>{{__('name')}}</th>
                    <th>{{__('city')}}</th>
                    <th>{{__('status')}}</th>
                    <th>{{__('uuid')}}</th>
                    <th>{{__('last-login')}}</th>
                    <th>{{__('coursesCount')}}</th>
                    <th>{{__('profile')}}</th>
                    <th>{{__('control')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($objects as $ob)
                    <tr>
                        <td>{{$ob->first_name . ' ' . $ob->last_name}}</td>
                        <td>{{$ob->city->name ?? '-'}}</td>
                        <td>
                            @if($ob->banned)
                                <span class="badge badge-danger p-2">{{__('banned')}}</span>
                            @else
                                <span class="badge badge-success p-2">{{__('activated')}}</span>
                            @endif
                        </td>
                        <td>{{ $ob->id ?? '-'}}</td>
                        <td>{{$ob->updated_at->diffForHumans()}}</td>
                        <td>
                            <p class="btn btn-info"> {{$ob->userCourses->count()}}</p>
                        </td>
                        <td>
                            @if(!$ob->instructor)
                                <a class="btn btn-outline-info mx-2" href="{{route('admin.users.profile',$ob->id)}}"><i class="fas fa-user"></i></a>
                                @else
                                <a href="{{route('admin.users.upgrade',$ob->id)}}" class="grd-btn" href="">

                                {{__('profile')}}
                                </a>
                            @endif
                        </td>

                        <td>
                            <button class="btn btn-danger"
                                    onclick="confirmDelete('{{route('admin.users.delete',$ob->id)}}')"
                                    data-toggle="modal" data-target="#delete-model">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <a class="btn btn-outline-info mx-2" href="{{route('admin.users.profile',$ob->id)}}"><i class="fas fa-user"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>


    <!-- add model -->
    <div class="modal fade" id="addModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">{{__('add_users')}}</h4></div>
                <form action="{{route('admin.users.store')}}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="uuid" value="uuid">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('first_name')}}</label>
                                    <input type="text" name="first_name" required class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('last_name')}}</label>
                                    <input type="text" name="last_name"  required class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('phone')}}</label>
                                    <input type="number" name="phone" minlength="10" required class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('email')}}</label>
                                    <input type="email" name="email"  required class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('password')}}</label>
                                    <input type="password" name="password" required class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('country')}}</label>
                                    <select name="country_id" class="form-control" id="country" required>
                                        <option value="" selected hidden>{{__('choose_country')}}</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('city')}}</label>
                                    <select name="city_id" class="form-control city" required>
                                        <option value="" selected hidden>{{__('choose_city')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary">{{__('save')}}</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-admin.notify-all type="{{\App\Models\User::STUDENT}}"/>
    <x-admin.notify-one/>

@endsection

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


{{--------------Hijri Date----------------}}
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

</script>

<script>

   $('select#banned,select#city').on('change',function (){
       $('#datatable-table')        .DataTable().destroy();
       $('#datatable-table')        .DataTable();
       $('.dataTables_filter input').val($(this).val()).keyup();
   });

    function setNotifyUserId(id)
    {
        $('.notify_user_id').val(id);
    }


</script>
<!--
<script type="text/javascript">

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
-->
@endsection
