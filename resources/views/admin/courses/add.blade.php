@extends('admin.layout.master')
@section('content')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <section class="content sectionFor">
        <form action="{{route('admin.courses.store')}}" method="post" role="form" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>{{__('category')}}</label>
                            <select name="category_id" class="form-control" id="category_id" required>
                                <option value="" selected hidden disabled>{{__('choose_category')}}</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
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
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{__('course_image')}}</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{__('promotional_video')}}</label>
                            <input type="file" accept="video/mp4,video/x-m4v,video/*" name="promotional_video" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{__('title_ar')}}</label>
                            <input type="text" name="title_ar" value="{{old('title_ar')}}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{__('title_en')}}</label>
                            <input type="text" name="title_en" value="{{old('title_en')}}"  required class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{__('description_ar')}}</label>
                            <textarea name="description_ar"  required class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{__('description_en')}}</label>
                            <textarea name="description_en" required class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{__('price')}}</label>
                            <input type="number" name="price" required value="{{old('price')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{__('discount')}}</label>
                            <input type="number" name="discount" required value="{{old('discount')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>{{__('level')}}</label>
                            <select name="level" class="form-control" id="country"  required>
                                <option value="" selected hidden >{{__('choose_level')}}</option>
                                <option value="junior"   >{{__('junior')}}</option>
                                <option value="mid"   >{{__('mid_level')}}</option>
                                <option value="advanced"   >{{__('advanced')}}</option>
                            </select>
                        </div>
                    </div>

                </div>

                <h3>{{__('course_requirements')}}</h3>

                <div class="row">
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="requirements[1][name_ar]"required  placeholder="{{__('Add_ar')}}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="requirements[1][name_en]" required  placeholder="{{__('Add_en')}}"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="btn btn-success width_100 botner" id="add-requirements">+</div>
                        </div>
                    </div>
                </div>
                <div id="more-requirements">

                </div>

                <hr>
                <h3>{{__('course_lectures')}}</h3>
                <hr>
                <div class="row">
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="course_lectures[1][name_ar]"
                                           placeholder="{{__('lecture_name_ar')}}" required class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <input type="text" name="course_lectures[1][name_en]"
                                               placeholder="{{__('lecture_name_en')}}" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-sm-4">--}}
                                {{--<div class="form-group">--}}
                                    {{--<input type="text" name="course_lectures[1][content][1][name_ar]"--}}
                                           {{--placeholder="{{__('Add_ar')}}" class="form-control">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-4">--}}
                                {{--<div class="form-group">--}}
                                    {{--<input type="text" name="course_lectures[1][content][1][name_en]"--}}
                                           {{--placeholder="{{__('Add_en')}}" class="form-control">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-4">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<div class="btn btn-success width_100" data-id="1" id="add-course-lectures-files">+</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-8">--}}
                                {{--<div class="form-group">--}}
                                    {{--<input type="file" name="course_lectures[1][content][1][file]" class="form-control ">--}}
                                {{--</div>--}}
                            {{--</div>--}}


                            <div id="more-course-lectures-files-1" class="row width_100">

                            </div>
                            <div class="col-sm-12">
                                <h5>{{__('course_lectures_files')}}</h5>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <input type="text" name="course_lectures[1][tests][name_ar]"
                                               placeholder="{{__('lecture_name_ar')}}" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <input type="text" name="course_lectures[1][tests][name_en]"
                                               placeholder="{{__('lecture_name_en')}}" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
{{--                                    <input type="file" accept="application/pdf" name="course_lectures[1][tests][file]" required class="form-control ">--}}
                                    <textarea  name="course_lectures[1][tests][file]" rows="8" cols="7" id="file" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="btn btn-success width_100 botner" data-id="1" id="add-course-lectures">+</div>
                        </div>
                    </div>
                </div>
                <div id="more-course-contents">

                </div>
                <hr>
                <h3>{{__('course_benefits')}}</h3>
                <hr>
                <div class="row">
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="benefits[1][name_ar]" required placeholder="{{__('Add_ar')}}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="benefits[1][name_en]" required placeholder="{{__('Add_en')}}"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="btn btn-success width_100 botner" id="add-benefits">+</div>
                        </div>
                    </div>
                </div>
                <div id="more-benefits">

                </div>

                <hr>
                <h3>{{__('course_contents')}}</h3>
                <hr>
                <div class="row">
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="contents[1][name_ar]" required placeholder="{{__('Add_ar')}}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="contents[1][name_en]" required  placeholder="{{__('Add_en')}}"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="btn btn-success width_100 botner" id="add-contents">+</div>
                        </div>
                    </div>
                </div>
                <div id="more-contents">

                </div>

            </div>

            <hr>
            <h3>{{__('course_certificates')}}</h3>
            <hr>
            <div class="row" style="margin: 8px;">
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="certificates[1][title_ar]" required placeholder="{{__('Add_ar')}}"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="certificates[1][title_en]" required placeholder="{{__('Add_en')}}"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="certificates[1][details_ar]" required placeholder="{{__('Add_ar')}}"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" name="certificates[1][details_en]" required placeholder="{{__('Add_en')}}"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="file" accept="application/pdf" name="certificates[1][file]" required class="form-control ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="btn btn-success width_100 botner" id="add-certificates">+</div>
                    </div>
                </div>
            </div>
            <div id="more-certificates">

            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">{{__('save')}}</button>
            </div>
            </div>

        </form>
    </section>
@endsection
<script src="{{setAsset('dashboard/js/jquery.js')}}"></script>

@section('script')
    <script type="text/javascript">

        var x         = 2;
        $(document).on('click', '#add-requirements', function () {
            var $body = $('#more-requirements');
            var ajax  = new XMLHttpRequest();
            ajax      .open("GET"   , "{{url('admin-course-requirement')}}" + '/'+ x, false);
            ajax      .send();
            $body     .append(ajax.responseText);
            x++;
        });

        $(document).on('click', '#add-course-lectures', function () {
            var $body = $('#more-course-contents');
            var ajax  = new XMLHttpRequest();
            ajax      .open("GET"   , "{{url('admin-course-lectures')}}" + '/'+ x + '/' + x+1, false);
            ajax      .send();
            $body     .append(ajax.responseText);
            x++;
        });

        $(document).on('click', '#add-benefits', function () {
            var $body = $('#more-benefits');
            var ajax  = new XMLHttpRequest();
            ajax      .open("GET"   , "{{url('admin-course-benefits')}}" + '/'+ x, false);
            ajax      .send();
            $body     .append(ajax.responseText);
            x++;
        });

        $(document).on('click', '#add-contents', function () {
            var $body = $('#more-contents');
            var ajax  = new XMLHttpRequest();
            ajax      .open("GET"   , "{{url('admin-course-contents')}}" + '/'+ x, false);
            ajax      .send();
            $body     .append(ajax.responseText);
            x++;
        });

        $(document).on('click', '#add-certificates', function () {
            var $body = $('#more-certificates');
            var ajax  = new XMLHttpRequest();
            ajax      .open("GET"   , "{{url('admin-course-certificates')}}" + '/'+ x, false);
            ajax      .send();
            $body     .append(ajax.responseText);
            x++;
        });
        let y = 1 ;
        $(document).on('click', '#add-course-lectures-files', function () {
            var id     =  $(this).data('id');
            var $body = $('#more-course-lectures-files-' + id);
            var ajax  = new XMLHttpRequest();

            if(id == 1)
                x= 1;
            else
                y = x + 1;



            ajax      .open("GET"   , "{{url('admin-course-lectures-files')}}" + '/'+ x + '/' + y , false);
            ajax      .send();
            $body     .append(ajax.responseText);
            x++;
            y++;
        });



        $(document).on('click', '#remove-requirements', function () {
            $(this).parent().closest('.row').remove();
        });

        $(document).on('click', '#remove-benefits', function () {
            $(this).parent().closest('.row').remove();
        });

        $(document).on('click', '#remove-contents', function () {
            $(this).parent().closest('.row').remove();
        });

        $(document).on('click', '#remove-course-lectures', function () {
            $(this).parent().closest('.row').remove();
        })
        $(document).on('click', '#remove-certificates', function () {
            $(this).parent().closest('.row').remove();
        })
        $(document).on('click', '#remove-course-lectures-files', function () {
            $(this).parent().closest('.width_100').remove();
        })
    </script>
@endsection
