@extends('admin.layout.master')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ">
                    <div class="page-header callout-primary d-flex justify-content-between">
                        <h2>{{__('courses_videos')}}</h2>
{{--                        <button type="button" data-toggle="modal" data-target="#addModel" class="btn btn-primary btn-wide waves-effect waves-light">--}}
{{--                            <i class="fas fa-plus"></i> {{__('add_lecture')}}--}}
{{--                        </button>--}}
                    </div>
                </div>
            </div>
        </div>

        <div class="card page-body">
            <div class="table-responsive">
                <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                    <thead>
                    <tr>
                        <th>{{__('title_ar')}}</th>
                        <th>{{__('title_en')}}</th>
                        <th>{{__('file')}}</th>
                        <th>{{__('control')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objects->lectureFiles as $ob)
                        <tr>
                            <td>{{$ob->getTranslation('name', 'ar')}}</td>
                            <td>{{$ob->getTranslation('name', 'en')}}</td>
                            <td>
                                <a data-id="{{$ob->file}}" class="fa fa-eye btn btn-alt-success click" data-target="#myModal" data-toggle="modal"></a>
                                <!-- Modal HTML -->
                                <div id="myModal" class="modal fade" >
                                    <div class="modal-dialog" >
                                        <div class="modal-content" >
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Lecture Video</h4>

                                            </div>
                                            <div class="modal-body">
                                                <div class="embed-responsive embed-responsive-16by9" id="swap1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-success mx-2"  onclick="editLectureFiles({{$ob}})" data-toggle="modal" data-target="#editLectureFilesModel"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.courses.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
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

{{--    <!-- add model -->--}}
{{--    <div class="modal fade" id="addModel">--}}
{{--        <div class="modal-dialog modal-lg">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header"><h4 class="modal-title">{{__('add_lecture')}}</h4></div>--}}
{{--                <form action="{{route('admin.courses.addLectureFile')}}" method="post" role="form" enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class="row">--}}
{{--                            <input type="hidden" name="course_lecture_id" value="{{$id}}">--}}
{{--                            <div class="col-sm-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>{{__('file')}}</label>--}}
{{--                                    <input type = "file" name = "file"    accept="video/mp4,video/x-m4v,video/*"    required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>{{__('name_ar')}}</label>--}}
{{--                                    <input type="text" name="name_ar" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>{{__('name_en')}}</label>--}}
{{--                                    <input type="text" name="name_en" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer justify-content-between">--}}
{{--                        <button type="submit" class="btn btn-primary">{{__('save')}}</button>--}}
{{--                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


    <!-- edit model LectureFilesModel -->
    <div class="modal fade" id="editLectureFilesModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">{{__('edit_lecture_files')}}</h4></div>
                <form action=""  id="editLectureFilesForm" method="post" role="form" enctype="multipart/form-data">
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

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('Iframe video')}}</label>
                                    <textarea  name="file" rows="8" cols="7" id="file" class="form-control"></textarea>
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

        {{--function edit(ob){--}}
        {{--    $('#editForm')      .attr("action","{{route('admin.courses.update','obId')}}".replace('obId',ob.id));--}}
        {{--};--}}

        function editLectureFiles(ob){

            $('#editLectureFilesForm') .attr("action","{{route('admin.lectures.update','obId')}}".replace('obId',ob.id));
            $('#name_ar')             .val(ob.name.ar);
            $('#name_en')             .val(ob.name.en);
            $('#file')                .val(ob.file);
        };

        // $(document).on('click','.view-video',function(){
        //     console.log($(this).attr('data-link'));
        //     $('#myModal').modal();
        //     $("#playvideo").attr('src', $(this).attr('data-link'));
        // })

        //   ================== IFrame ===================

        {{--var newHtml = {{$course->id}};--}}
        var newHtml = $(".click").data("id");
        // alert(newHtml);
        $(".click").click(function() {

            $("#swap1").html('');
            console.log(newHtml)
            $("#swap1").html(newHtml);
        });

    </script>
@endsection
