@extends('admin.layout.master')
@section('content')


<section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ">
                    <div class="page-header callout-primary d-flex justify-content-between">
                        <h2>{{__('supervisors')}}</h2>
                        <button type="button" data-toggle="modal" data-target="#addModel" class="btn btn-primary btn-wide waves-effect waves-light">{{__('add_supervisors')}}
                        </button>
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
                        <th>{{__('email')}}</th>
                        <th>{{__('control')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admins as $ob)
                        <tr>
                            <td>{{$ob->name }}</td>
                            <td>{{$ob->email}}</td>
                            <td>
                            <button class="btn btn-success mx-2"  onclick="edit({{$ob}})" data-toggle="modal" data-target="#editModel"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.admins.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
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


 <!-- add model -->
 <div class="modal fade" id="addModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h4 class="modal-title">{{__('add_supervisors')}}</h4></div>
            <form action="{{route('admin.admins.store')}}" method="post" role="form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="uuid" value="uuid">
                <div class="modal-body">
                    <div class="row">

                        <div class = "col-sm-12 text-center">
                            <label class = "mb-0">{{__('avatar')}}</label>
                            <div class = "text-center">
                                <div class = "images-upload-block single-image">
                                    <label class = "upload-img">
                                        <input type = "file" name = "avatar" id = "image" accept = "image/*" class = "image-uploader" >
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </label>
                                    <div class = "upload-area"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>{{__('name')}}</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('email')}}</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('password')}}</label>
                                <input type="password" name="password" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>{{__('role')}}</label>
                                <select name="role_id" class="form-control">
                                    <option value="" selected hidden disabled>{{__('choose_role')}}</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
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
<!-- end add model -->

<!-- edit model -->
<div class="modal fade" id="editModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"><h4 class="modal-title">{{__('edit_supervisors')}}</h4></div>
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
                                <label>{{__('name')}}</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('email')}}</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('password')}}</label>
                                <input type="password" name="password"  minlength="6" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('role')}}</label>
                                <select name="role_id" class="form-control" id="role_id" required>
                                    <option value="" selected hidden disabled>{{__('choose_role')}}</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
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
<!-- end edit model -->

@endsection
@section('script')
    <script>

        function edit(ob){

            $('#editForm')      .attr("action","{{route('admin.admins.update','obId')}}".replace('obId',ob.id));
            $('#name')          .val(ob.name);
            $('#email')         .val(ob.email);


            $( '#role_id option' ).each( function () {
                if ( $( this ).val() == ob.role_id )
                    $( this ).attr( 'selected', '' )
            } );

            let image = $( '#upload_area_img' );
            image.empty();
            image.append( '<div class="uploaded-block" data-count-order="1"><img src="' + ob.avatar + '"><button class="close">&times;</button></div>' );
        }
    </script>
@endsection
