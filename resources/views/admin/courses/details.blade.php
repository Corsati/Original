@extends('admin.layout.master')
@section('content')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <style>
        .upload-img i {
            margin-top: 25px;
        }
        label{
            font-size: 20px !important;
        }
        hr {
            border: 0;
            clear:both;
            display:block;
            width: 96%;
            background-color: #677582;
            height: 1px;
        }
    </style>

    <section class="content">
        <div class="container-fluid">
            <div class="row">


                <div class="col-md-3">
                    <div class="card">
                        <div class="  p-2">
                            <div class="tab-content">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="{{$object->image}}"
                                             alt="User profile picture"
                                             style="height: 100px;"
                                         >
                                    </div>
                                    <h3 class="profile-username text-center">{{$object->title}}</h3>
                                    <p class="text-muted text-center">{{$object->category->name}}</p>
                                    <ul class="list-group list-group-unbordered mb-3">

                                        <li class="list-group-item">
                                            <a class="float-left    padding-5 white" target="_blank" href="{{$object->image}}">{{__('show_image')}}</a><b>{{__('image')}}</b>
                                        </li>
                                        <li class="list-group-item">
                                            <a class="float-left    padding-5 white" target="_blank" href="{{$object->promotional_video	}}">{{__('show')}}</a><b>{{__('promotional_video')}}</b>
                                        </li>
                                        <li class="list-group-item">
                                            <p class="float-left    padding-5 white" >{{$object->	price	}}</p><b>{{__('price')}}</b>
                                        </li>
                                        <li class="list-group-item">
                                            <p class="float-left    padding-5 white"   >{{$object->	discount	}}</p><b>{{__('discount')}}</b>
                                        </li>
                                        <li class="list-group-item">
                                            <p class="float-left    padding-5 white"   >{{$object->	level()->first()->name	}}</p><b>{{__('level')}}</b>
                                        </li>
                                        <li class="list-group-item">
                                            <p class="float-left    padding-5 white"   >{{$object->duration->to	}}</p><b>{{__('total_hours')}}</b>
                                        </li>
                                        <li class="list-group-item">
                                            <p class="float-left    padding-5 white"   >{{$object->	user->first_name	}}</p><b>{{__('user_name')}}</b>
                                        </li>
                                        <li class="list-group-item">
                                            <p class="float-left    padding-5 white"   >{{$object->	user->phone	}}</p><b>{{__('phone')}}</b>
                                        </li>
                                         <li class="list-group-item">
                                            <p class="   padding-5 white"   >
                                                {{$object->description	}}
                                            </p>

                                        </li>
                                        <li class="list-group-item">
                                            <a class="float-left    padding-5 white">1</a><b>{{__('courses_orders_count')}}</b>
                                        </li>
                                        <li class="list-group-item">
                                            <a class="float-left    padding-5">0</a><b>{{__('course_views_count')}}</b>
                                        </li>

                                    </ul>
                                </div>
                                <!-- /.card-body -->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#courses" data-toggle="tab">{{__('courses')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#benefits" data-toggle="tab">{{__('benefits')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#certificates" data-toggle="tab">{{__('certificate')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#contents" data-toggle="tab">{{__('contents')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#lectures" data-toggle="tab">{{__('lectures')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#requirements" data-toggle="tab">{{__('requirements')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#comments" data-toggle="tab">{{__('comments')}}</a></li>
                            </ul>
                        </div><!-- /.card-header -->

                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane active" id="courses">
                                    <div class="table-responsive">
                                        <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{__('title_en')}}</th>
                                                <th>{{__('title_ar')}}</th>
                                                <th>{{__('description_en')}}</th>
                                                <th>{{__('description_ar')}}</th>
                                                <th>{{__('category')}}</th>
                                                <th>{{__('control')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$object->getTranslation('title','en')}}</td>
                                                    <td>{{$object->getTranslation('title','ar')}}</td>
                                                    <td>{{$object->getTranslation('description','en')}}</td>
                                                    <td>{{$object->getTranslation('description','ar')}}</td>
                                                    <td>{{$object->category->getTranslation('name', lang())}}</td>
                                                    <td>
                                                        <button class="btn btn-success mx-2"  onclick="edit({{$object}})" data-toggle="modal" data-target="#editModel"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.courses.delete',$object->id)}}')" data-toggle="modal" data-target="#delete-model">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="benefits">
                                    <div class="table-responsive">
                                        <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{__('name_ar')}}</th>
                                                <th>{{__('name_en')}}</th>
                                                <th>{{__('control')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($object->benefits as $ob)
                                                <tr>
                                                    <td>{{$ob->getTranslation('name', 'ar')}}</td>
                                                    <td>{{$ob->getTranslation('name', 'en')}}</td>
                                                    <td>
                                                        <button class="btn btn-success mx-2"  onclick="editBenefits({{$ob}})" data-toggle="modal" data-target="#editBenefitsModel"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.courses.benefits.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <div class="tab-pane " id="certificates">
                                    <div class="table-responsive">
                                        <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{__('name_ar')}}</th>
                                                <th>{{__('name_en')}}</th>
                                                <th>{{__('details_ar')}}</th>
                                                <th>{{__('details_en')}}</th>
                                                <th>{{__('file')}}</th>
                                                <th>{{__('control')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($object->certificates as $ob)
                                                <tr>
                                                    <td>{{$ob->getTranslation('title', 'ar')}}</td>
                                                    <td>{{$ob->getTranslation('title', 'en')}}</td>
                                                    <td>{{$ob->getTranslation('details', 'ar')}}</td>
                                                    <td>{{$ob->getTranslation('details', 'en')}}</td>
                                                    <td>
                                                        <a target="_blank" href="{{$ob->file}}">{{__('show_certificate')}}</a>
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-success mx-2"  onclick="editCertificate({{$ob}})" data-toggle="modal" data-target="#editCertificateModel"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.courses.certificate.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane " id="contents">
                                    <div class="table-responsive">
                                        <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{__('name_ar')}}</th>
                                                <th>{{__('name_en')}}</th>
                                                <th>{{__('control')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($object->contents as $ob)
                                                <tr>
                                                    <td>{{$ob->getTranslation('name', 'ar')}}</td>
                                                    <td>{{$ob->getTranslation('name', 'en')}}</td>
                                                    <td>
                                                        <button class="btn btn-success mx-2"  onclick="editContents({{$ob}})" data-toggle="modal" data-target="#editContentsModel"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.courses.contents.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane " id="lectures">
                                    <div class="table-responsive">
                                        <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{__('name_ar')}}</th>
                                                <th>{{__('name_en')}}</th>
                                                <th>{{__('videos')}}</th>
                                                <th>{{__('control')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($object->lectures as $ob)
                                                <tr>
                                                    <td>{{$ob->getTranslation('name', 'ar')}}</td>
                                                    <td>{{$ob->getTranslation('name', 'en')}}</td>
                                                    <td>
                                                        <a href="{{route('admin.courses.video',$ob->id)}}">{{__('show')}}</a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success mx-2"  onclick="editLectures({{$ob}})" data-toggle="modal" data-target="#editLecturesModel"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.courses.lectures.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane " id="requirements">
                                    <div class="table-responsive">
                                        <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{__('name_en')}}</th>
                                                <th>{{__('name_ar')}}</th>
                                                <th>{{__('control')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($object->requirements as $ob)
                                                <tr>
                                                    <td>{{$ob->getTranslation('name','en')}}</td>
                                                    <td>{{$ob->getTranslation('name','ar')}}</td>
                                                    <td>
                                                        <button class="btn btn-success mx-2"  onclick="editRequirement({{$ob}})" data-toggle="modal" data-target="#editRequirementModel"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.courses.requirements.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
                                                            <i class="fas fa-trash-alt"></i>
                                                   </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane " id="comments">
                                    <div class="table-responsive">
                                        <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{__('name')}}</th>
                                                <th>{{__('comment')}}</th>
                                                <th>{{__('control')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($object->comments as $ob)
                                                <tr>
                                                    <td>{{$ob->user->first_name}} {{$ob->user->last_name}}</td>
                                                    <td>{{$ob->comment}}</td>
                                                    <td>
                                                        <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.courses.comments.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
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
    </section>

    <!-- edit Course model -->
    <div class="modal fade" id="editModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">{{__('edit_courses')}}</h4></div>
                <form action=""  id="editForm" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class = "col-md-6 text-center">
                                <label class = "mb-0">{{__('image')}}</label>
                                <div class = "text-center">
                                    <div class = "images-upload-block single-image">
                                        <label class = "upload-img">
                                            <input type = "file" name = "image" id="image" accept = "image/*" class = "image-uploader">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </label>
                                        <div class = "upload-area" id="upload_area_img"></div>
                                    </div>
                                </div>
                            </div>

                            <div class = "col-md-6 text-center">
                                <label class = "mb-0">{{__('promotional_video')}}</label>
                                <div class = "text-center">
                                    <div class = "images-upload-block single-image">
                                        <label class = "upload-img">
                                            <input type="file" accept="video/mp4,video/x-m4v,video/*"
                                                   class="image-uploader" id="promotional_video" name="promotional_video">
                                            <i class="fas fa-plus"></i>
                                        </label>
                                        <div class = "upload-area" id="upload_area_img"></div>
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
                                    <label>{{__('description_ar')}}</label>
                                    <textarea  name="description_ar" id="description_ar" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('description_en')}}</label>
                                    <textarea  name="description_en" id="description_en" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('price')}}</label>
                                    <input type="number" name="price" id="price" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('discount')}}</label>
                                    <input type="text" name="discount" id="discount" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('total_hours')}}</label>
                                    <input type="number" name="total_hours" id="total_hours" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{__('category')}}</label>
                                            <select name="category_id" class="form-control" id="category_id" >
                                                <option value="" selected hidden value="">{{__('choose_category')}}</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}"> {{$category->getTranslation('name', lang())}}</option>
                                                    @endforeach
                                            </select>
                                    </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('level')}}</label>
                                    <select class="form-control" id="level" name="level"   title="{{__('web.select-level')}}">
                                        <option value="" selected hidden >{{__('choose_level')}}</option>
                                        <option  {{$object  && $object->level  == 'junior'  ? 'selected' :'' }} value="junior"     >{{__('web.junior')}}</option>
                                        <option  {{$object  && $object->level  == 'mid'     ? 'selected' :'' }} value="mid"        >{{__('web.mid_level')}}</option>
                                        <option  {{$object  && $object->level  == 'advanced'? 'selected' :'' }} value="advanced"   >{{__('web.advanced')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('instructor')}}</label>
                                    <select name="user_id" class="form-control" id="user_id" required>
                                        <option value="" selected hidden disabled>{{__('choose_instructor')}}</option>
                                        @foreach($instructors as $instructor)
                                            <option value="{{$instructor->id}}">{{$instructor->first_name}}  {{$instructor->last_name}}</option>
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

    <!-- edit model RequirementModel -->
    <div class="modal fade" id="editRequirementModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">{{__('edit_requirement')}}</h4></div>
                <form action=""  id="editRequirementForm" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('name_ar')}}</label>
                                    <input type="text" name="name_ar" id="name_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('name_en')}}</label>
                                    <input type="text" name="name_en" id="name_en" class="form-control">
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


    <!-- edit model LecturesModel -->
    <div class="modal fade" id="editLecturesModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">{{__('edit_Lectures')}}</h4></div>
                <form action=""  id="editLecturesForm" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('name_ar')}}</label>
                                    <input type="text" name="name_ar" id="lecture_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('name_en')}}</label>
                                    <input type="text" name="name_en" id="lecture_en" class="form-control">
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

    <!-- edit model BenefitsModel -->
    <div class="modal fade" id="editBenefitsModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">{{__('edit_benefits')}}</h4></div>
                <form action="" id="editBenefitsForm" method="post" role="form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('name_ar')}}</label>
                                    <input type="text" name="name_ar" id="benefit_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('name_en')}}</label>
                                    <input type="text" name="name_en" id="benefit_en" class="form-control">
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


    <!-- edit model ContentsModel -->
    <div class="modal fade" id="editContentsModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">{{__('edit_content')}}</h4></div>
                <form action=""  id="editContentsForm" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('name_ar')}}</label>
                                    <input type="text" name="name_ar" id="content_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('name_en')}}</label>
                                    <input type="text" name="name_en" id="content_en" class="form-control">
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

 <!-- edit model CertificateModel -->
    <div class="modal fade" id="editCertificateModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">{{__('edit_certificate')}}</h4></div>
                <form action="" id="editCertificateForm" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('title_ar')}}</label>
                                    <input type="text" name="title_ar" id="certificate_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('title_en')}}</label>
                                    <input type="text" name="title_en" id="certificate_en" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('details_ar')}}</label>
                                    <input type="text" name="details_ar" id="details_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('details_en')}}</label>
                                    <input type="text" name="details_en" id="details_en" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="file" accept="application/pdf" name="file" class="form-control " id="file">
                                    <div class = "upload-area" id="upload_area_file"></div>
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
    <script>
        function edit(ob){

            $('#editForm')             .attr("action","{{route('admin.courses.update','obId')}}".replace('obId',ob.id));
            $('#title_ar')             .val(ob.title.ar);
            $('#title_en')             .val(ob.title.en);
            $('#description_en')       .val(ob.description.en);
            $('#description_ar')       .val(ob.description.ar);
            $('#price')                .val(ob.price);
            $('#total_hours')          .val(ob.total_hours);
            $('#discount')             .val(ob.discount)
            $( '#category_id option')  .each( function () {
                if ( $( this ).val() == ob.category_id )
                    $( this ).attr( 'selected', '' )
            } );
            $( '#level option')  .each( function () {
                if ( $( this ).val() == ob.level )
                    $( this ).attr( 'selected', '' )
            } );
            $( '#user_id option')  .each( function () {
                if ( $( this ).val() == ob.user_id )
                    $( this ).attr( 'selected', '' )
            } );

            let image = $('#upload_area_img' );
            image.empty();
            image.append( '<div class="uploaded-block" data-count-order="1"><img src="' + ob.image + '"><button class="close">&times;</button></div>' );

            var uploadField = document.getElementById("promotional_video");

            uploadField.onchange = function() {
                if(this.files[0].size > 2097152){
                    alert("File is too big!");
                    this.value = "";
                };
            };
            $(document).on("change", '.file-uploads', function (event) {
                let file = event.target.files[0];
                let blobURL = URL.createObjectURL(file);
                document.querySelector("video").src = blobURL;
            })
        };
        function editRequirement(ob){

            $('#editRequirementForm') .attr("action","{{route('admin.courses.requirements.update','obId')}}".replace('obId',ob.id));
            $('#name_ar')             .val(ob.name.ar);
            $('#name_en')             .val(ob.name.en);
        };

        function editLectures(ob){

            $('#editLecturesForm') .attr("action","{{route('admin.courses.lectures.update','obId')}}".replace('obId',ob.id));
            $('#lecture_ar')             .val(ob.name.ar);
            $('#lecture_en')             .val(ob.name.en);
        };
        function editBenefits(ob){

            $('#editBenefitsForm') .attr("action","{{route('admin.courses.benefits.update','obId')}}".replace('obId',ob.id));
            $('#benefit_ar')             .val(ob.name.ar);
            $('#benefit_en')             .val(ob.name.en);
        };
        function editContents(ob){

            $('#editContentsForm') .attr("action","{{route('admin.courses.contents.update','obId')}}".replace('obId',ob.id));
            $('#content_ar')             .val(ob.name.ar);
            $('#content_en')             .val(ob.name.en);
        };
        function editCertificate(ob){

            $('#editCertificateForm') .attr("action","{{route('admin.courses.certificates.update','obId')}}".replace('obId',ob.id));
            $('#certificate_ar')             .val(ob.title.ar);
            $('#certificate_en')             .val(ob.title.en);
            $('#details_ar')                 .val(ob.details.ar);
            $('#details_en')                 .val(ob.details.en);
            var uploadField = document.getElementById("file");

            uploadField.onchange = function() {
                if(this.files[0].size > 2097152){
                    alert("File is too big!");
                    this.value = "";
                };
            };
            $(document).on("change", '.file-uploads', function (event) {
                let file = event.target.files[0];
                let blobURL = URL.createObjectURL(file);
                document.querySelector("file").src = blobURL;
            })
        };
    </script>
@endsection
