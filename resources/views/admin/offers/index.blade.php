@extends('admin.layout.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ">
                    <div class="page-header callout-primary d-flex justify-content-between">
                        <h2>{{__('offers')}}</h2>
                        @if(request()->is('admin/user-offers'))
                            @if(count($objects) == 0 )
                            <button type="button" data-toggle="modal" data-target="#addModel" class="btn btn-primary btn-wide waves-effect waves-light">
                                {{__('add_offers')}}
                            </button>
                              @endif
                            @else
                            @if(count($objects) == 0 )
                                <button type="button" data-toggle="modal" data-target="#addModel" class="btn btn-primary btn-wide waves-effect waves-light">
                                    {{__('add_offers')}}
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card page-body">
            <div class="table-responsive">
                <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                    <thead>
                    <tr>
                        <th>{{__('image_en')}}</th>
                        <th>{{__('image_ar')}}</th>
                        <th>{{__('title')}}</th>
                        <th>{{__('sub_title')}}</th>

                        <th>{{__('counter')}}</th>
                        <th>{{__('control')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objects as $ob)
                        <tr>
                            <td><a target="_blank" href="{{$ob ->image ?? ''}}"> <img src="{{$ob ->image??''}}" width="60" height="60"> </a></td>
                            <td><a target="_blank" href="{{$ob ->image_ar ?? ''}}"> <img src="{{$ob->image_ar ??''}}" width="60" height="60"> </a></td>
                            <td>{{$ob->title}}</td>
                            <td>{{$ob->sub_title}}</td>
                            <td>
                                @if($ob->type == 'guest')
                                    @if($ob->open_counter)
                                        <a href="{{route('admin.offers.status',['id' => $ob->id ])}}"><span class="btn btn-danger">{{__('hide')}}</span></a>
                                    @else
                                        <a href="{{route('admin.offers.status',['id' => $ob->id ])}}"><span class="btn btn-primary">{{__('show')}}</span></a>
                                    @endif
                                @else
                                    {{__('not_supported')}}
                                @endif
                            </td>
                             <td>
                                <button class="btn btn-success mx-2"  onclick="edit({{$ob}})" data-toggle="modal" data-target="#editModel"><i class="fas fa-edit"></i></button>
                                <!--
                                <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.offers.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                -->
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
                <div class="modal-header"><h4 class="modal-title">{{__('add_offers')}}</h4></div>
                <form action="{{route('admin.offers.store')}}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class = "col-sm-6 text-center">
                                <label class = "mb-0">{{__('image_en')}}</label>
                                <div class = "text-center">
                                    <div class = "images-upload-block single-image">
                                        <label class = "upload-img">
                                            <input type = "file" name = "image"  accept = "image/*" class = "image-uploader" required>
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </label>
                                        <div class = "upload-area"></div>
                                    </div>
                                </div>
                            </div>

                                <div class = "col-sm-6 text-center">
                                    <label class = "mb-0">{{__('image_ar')}}</label>
                                    <div class = "text-center">
                                        <div class = "images-upload-block single-image">
                                            <label class = "upload-img">
                                                <input type = "file" name ="image_ar"  accept = "image/*" class = "image-uploader" required>
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </label>
                                            <div class = "upload-area"></div>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('title_ar')}}</label>
                                    <input type="text" name="title_ar" required class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('title_en')}}</label>
                                    <input type="text" name="title_en" required class="form-control">
                                </div>
                            </div>
                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('sub_title')}}</label>
                                    <input type="text" name="sub_title_ar" required class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('sub_title')}}</label>
                                    <input type="text" name="sub_title_en" required class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('expire_date')}}</label>
                                    <input type="date" name="expire_date" min="{{date("Y-m-d")}}"   class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('details_ar')}}</label>
                                    <textarea type="text" name="description_ar" required class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('details_en')}}</label>
                                    <textarea type="text" name="description_en" required class="form-control"></textarea>
                                </div>
                            </div>
                            @if(request()->is('admin/user-offers'))
                             <input type="hidden" name="type" value="auth">
                            @endif
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
                <div class="modal-header"><h4 class="modal-title">{{__('edit_offers')}}</h4></div>
                <form action=""  id="editForm" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="row">
                            <div class = "col-sm-6 text-center">
                                <label class = "mb-0">{{__('image_en')}}</label>
                                <div class = "text-center">
                                    <div class = "images-upload-block single-image">
                                        <label class = "upload-img">
                                            <input type = "file" name = "image"  id="image" accept = "image/*" class = "image-uploader" >
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </label>
                                        <div class = "upload-area"></div>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-sm-6 text-center">
                                <label class = "mb-0">{{__('image_ar')}}</label>
                                <div class = "text-center">
                                    <div class = "images-upload-block single-image">
                                        <label class = "upload-img">
                                            <input type = "file" name ="image_ar" id="image_ar"  accept = "image/*" class = "image-uploader" >
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </label>
                                        <div class = "upload-area"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('title_ar')}}</label>
                                    <input type="text" name="title_ar" id="title_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('title_en')}}</label>
                                    <input type="text" name="title_en" id="title_en" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('sub_title')}}</label>
                                    <input type="text" name="sub_title_ar" id="sub_title_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('sub_title')}}</label>
                                    <input type="text" name="sub_title_en" id="sub_title_en" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('expire_date')}}</label>
                                    <input type="date" name="expire_date" id="expire_date"     class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('expire_date')}}</label>
                                    <input type="text"   id="expire_date_text"  readonly   class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('details_ar')}}</label>
                                    <textarea type="text" name="description_ar" id="description_ar" required class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('details_en')}}</label>
                                    <textarea type="text" name="description_en"  id="description_en" required class="form-control"></textarea>
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
    <script type="text/javascript">
        function edit(ob){
            $('#editForm')               .attr("action","{{route('admin.offers.update','obId')}}".replace('obId',ob.id));
            $('#title_ar')               .val(ob.title.ar);
            $('#title_en')               .val(ob.title.en);
            $('#sub_title_ar')           .val(ob.sub_title.ar);
            $('#sub_title_en')           .val(ob.sub_title.en);
            $('#expire_date')            .val(ob.expire_date);
            $('#expire_date_text')       .val(ob.expire_date);
            $('textarea#description_ar') .val(ob.description.ar);
            $('textarea#description_en') .val(ob.description.en);
        };

    </script>
@endsection
