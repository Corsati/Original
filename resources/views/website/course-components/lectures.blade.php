<div class="formGroupCont">

<div class="lectureContainer">
    <div class="form-group">
        <label for="title">  {{__('web.Lecture-title')}}</label>
        <input type="text" name="course_lectures[{{$index}}][title]" class="form-control" id="title" placeholder=" {{__('web.title-lecture')}}">
        <a href="#"   class="minus"><img src="{{setAsset('website/img/white_minus.png')}}" alt="minus"></a>
    </div>

    <div class="rowSpace mt-0">
        <div class="form-group">
            <label for="content">{{__('web.Lecture-content')}}</label>
            <input type="text" name="course_lectures[{{$index}}][course_lectures_files][{{$id}}][name]" required class="form-control" id="content" placeholder="{{__('web.Add-content-title')}}">
        </div>
        <div class="form-group">
            <label for="photo-upload" class="custom-file-upload">{{__('web.Update-files')}}</label>
            <input type="url" class="form-control uploadUrl" placeholder="https://www.youtube.com/watch?v=xxxxx"  name="course_lectures[{{$index}}][course_lectures_files][{{$id}}][video]" required >
            <a href="#" data-id="{{$index}}"  class="add" style="color: white"><img src="{{setAsset('website/img/white_plus.png')}}" alt="minus"></a>
        </div>
    </div>

</div>
</div>
