<hr>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-5">
                <div class="form-group">
                    <input type="text" name="course_lectures[{{$index}}][name_ar]"
                           placeholder="{{__('lecture_name_ar')}}" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <div class="form-group">
                        <input type="text" name="course_lectures[{{$index}}][name_en]"
                               placeholder="{{__('lecture_name_en')}}" class="form-control" required>
                    </div>
                </div>
            </div>
            {{--<div class="col-sm-4">--}}
                {{--<div class="form-group">--}}
                    {{--<input type="text" name="course_lectures[{{$index}}][content][{{$key}}][name_ar]"--}}
                           {{--placeholder="{{__('Add_ar')}}" class="form-control">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-sm-4">--}}
                {{--<div class="form-group">--}}
                    {{--<input type="text" name="course_lectures[{{$index}}][content][{{$key}}][name_en]"--}}
                           {{--placeholder="{{__('Add_en')}}" class="form-control">--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col-sm-4">--}}
                    {{--<div class="form-group">--}}
                        {{--<div class="btn btn-success width_100" data-id="{{$index}}" id="add-course-lectures-files">+</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-sm-8">--}}
                {{--<div class="form-group">--}}
                    {{--<input type="file" name="course_lectures[{{$index}}][content][{{$key}}][file]" class="form-control ">--}}
                {{--</div>--}}
            {{--</div>--}}


            <div id="more-course-lectures-files-{{$index}}" class="row width_100">

            </div>
            <div class="col-sm-12">
                <h5>{{__('course_lectures_tests')}}</h5>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <div class="form-group">
                        <input type="text" name="course_lectures[{{$index}}][tests][name_ar]"
                               required
                               placeholder="{{__('lecture_name_ar')}}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <div class="form-group">
                        <input type="text" name="course_lectures[{{$index}}][tests][name_en]"
                               required
                               placeholder="{{__('lecture_name_en')}}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="form-group">
{{--                    <input type="file" name="course_lectures[{{$index}}][tests][file]"  accept="application/pdf" required class="form-control ">--}}
                    <textarea  name="course_lectures[{{$index}}][tests][file]" rows="8" cols="7" id="file" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
