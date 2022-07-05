<div class="row width_100">
    <div class="col-sm-5">
        <div class="form-group">
            <input type="text" required name="course_lectures_files[{{$index}}][content][{{$key}}][name_ar]" placeholder="{{__('Add_ar')}}" class="form-control">
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <input type="text" required name="course_lectures_files[{{$index}}][content][{{$key}}][name_en]" placeholder="{{__('Add_en')}}" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
                <div class="btn btn-danger width_100" id="remove-course-lectures-files">-</div>
            </div>
        </div>
    </div>
    <div class="col-sm-10">
        <div class="form-group">
            <textarea name="course_lectures_files[{{$index}}][content][{{$key}}][file]"   class="form-control "></textarea>
        </div>
    </div>
</div>
