@extends('admin.layout.master')
@section('content')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <style type="text/css">
        .modal-open .select2-dropdown {
            z-index: 10060;
        }

        .modal-open .select2-close-mask {
            z-index: 10055;
        }

        .modal-open .select2-container--open { z-index: 999999 !important; width:100% !important; }

        .upload-img i {
            margin-top: 25px;
        }
        .modal-open .select2-container--open { z-index: 999999 !important; width:100% !important; }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ">
                    <div class="page-header callout-primary d-flex justify-content-between">
                        <h2>{{__('instructors')}}</h2>
                        <button type="button" data-toggle="modal" data-target="#messageAllModel"
                                class="btn btn-info btn-wide waves-effect waves-light">
                            {{__('notify_all')}}
                        </button>
                    </div>
                    <div class="page-header callout-primary d-flex">
                        <div class="col-md-4">
                            <div class="stati turquoise left">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                <div>
                                    <b>{{$newUsers}}</b>
                                    <span>{{__('new_instructors')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stati turquoise left">
                                <i class="fa fa-list-ol" aria-hidden="true"></i>
                                <div>
                                    <b>{{count($objects)}}</b>
                                    <span>{{__('total_instructors')}}</span>
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
            <div class="table-responsive">
                <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                    <thead>
                    <tr>
                        <th>{{__('name')}}</th>
                        <th>{{__('language')}}</th>
                        <th>{{__('city')}}</th>
                        <th>{{__('last-login')}}</th>
                        <th>{{__('show_profile')}}</th>
                        <th>{{__('activation')}}</th>
                        <th>{{__('control')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objects as $ob)
                        <tr>
                            <td>{{$ob->first_name . ' ' . $ob->last_name}}</td>
                            <td>{{strtoupper($ob->instructor->language)}}</td>
                            <td>{{$ob->city->name ?? '-'}}</td>
                            <td>{{$ob->updated_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('admin.instructors.profile',$ob->id)}}" class="grd-btn" href="" >
                                         {{__('show_profile')}}
                                 </a>
                            </td>
                            <td>
                                @if($ob->email_verified_at)
                                    <span class="btn btn-primary">{{__('activated')}}</span>
                                @else
                                    <a href="{{route('admin.users.activate',['id' => $ob->id])}}">
                                      <span class="btn btn-danger">{{__('not_active')}}</span>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.users.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <x-admin.notify-all type="{{\App\Models\User::INSTRUCTOR}}"/>
    <x-admin.notify-one/>
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
                                    <input type="text" name="first_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('last_name')}}</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('phone')}}</label>
                                    <input type="number"  minlength="10" name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('email')}}</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('about')}}</label>
                                    <textarea class="form-control"  name="about"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('country')}}</label>
                                    <select name="country_id" class="form-control" id="country"  required>
                                        <option value="" selected hidden >{{__('choose_country')}}</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('city')}}</label>
                                    <select name="city_id"  class="form-control city"  required>
                                        <option value="" selected hidden >{{__('choose_city')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="selects">
                                    <label for="field-1" class="control-label">{{__('Interested_fields')}}</label>
                                    <select class="form-control js-example-basic-multiple"  multiple data-width="100%"  name="tags[]" id="">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('password')}}</label>
                                    <input type="password" name="password" class="form-control" autocomplete="off">
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
    <!-- end add model -->

    <!-- edit model -->
    <div class="modal fade" id="editModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">{{__('edit_user')}}</h4></div>
                <form action=""  id="editForm" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class = "col-sm-12 text-center">
                                <label class = "mb-0">{{__('avatar')}}</label>
                                <div class = "text-center">
                                    <div class = "images-upload-block single-image">
                                        <label class = "upload-img">
                                            <input type = "file" name = "avatar" id = "image" accept = "image/*" class = "image-uploader">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </label>
                                        <div class = "upload-area" id="upload_area_img"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('first_name')}}</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('last_name')}}</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('phone')}}</label>
                                    <input type="number" name="phone" class="form-control" id="phone" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('email')}}</label>
                                    <input type="email" name="email" class="form-control" id="email" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('about')}}</label>
                                    <textarea class="form-control"  name="about" id="about"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('password')}}</label>
                                    <input type="password" name="password" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('country')}}</label>
                                    <select name="country_id" class="form-control" id="country_id" required>
                                        <option value="" selected hidden disabled>{{__('choose_country')}}</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('city')}}</label>
                                    <select name="city_id" class="form-control city" id="city_id" required>
                                        <option value="" selected hidden >{{__('choose_city')}}</option>
                                        @foreach($cities as $city)
                                            <option  value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <div class="icheck-primary d-inline mx-2">
                                        <input type="checkbox" name="banned"  id="banned">
                                        <label for="banned" dir="ltr"></label>
                                    </div>
                                    <label for="banned">{{__('ban')}}</label>
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
    <!-- end edit model -->

@endsection
<script src="{{setAsset('dashboard/js/jquery.js')}}"></script>

@section('script')
    <script type="text/javascript">
        function edit(ob){
            $('#editForm')      .attr("action","{{route('admin.users.update','obId')}}".replace('obId',ob.id));
            $('#first_name')    .val(ob.first_name);
            $('#last_name')     .val(ob.last_name);
            $('#phone')         .val(ob.phone);
            $('#email')         .val(ob.email);
            $('textarea#about') .val(ob.about);

            if ( ob.banned == 1 )
                $( "#banned" ).attr( 'checked', '' );
            else
                $( "#banned" ).removeAttr( 'checked', '' );

            $( '#role_id option' ).each( function () {
                if ( $( this ).val() == ob.role_id )
                     $( this ).attr( 'selected', '' )
            } );

            $( '#country_id option' ).each( function () {
                if ( $( this ).val() == ob.country_id )
                     $( this ).attr( 'selected', '' )
            } );

            $( '#city_id option' ).each( function () {
                if ( $( this ).val() == ob.city_id )
                     $( this ).attr( 'selected', '' )
            } );

            let image = $( '#upload_area_img' );
            image.empty();
            image.append( '<div class="uploaded-block" data-count-order="1"><img src="' + ob.avatar + '"><button class="close">&times;</button></div>' );
        }

        $('select#country,select#country_id').on('change', function (e) {
            $('.city').empty();
            var countryId  = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{route('admin.countries.cities')}}",
                dataType : "json",
                data: {
                    'country_id': countryId  ,
                    '_token'    : '{{csrf_token()}}'
                },
                success: function(data){
                    console.log(data)
                    $.each(data, function(i, d) {
                        $('.city').append('<option value="' + d.id + '">' + d.name.ar + '</option>');
                    });
                }
            });
        });
        $(document).ready(function() {
            $('#addModel').on('show.bs.modal', function() {
                $('.js-example-basic-multiple').select2();
            })
        });
    </script>
@endsection
