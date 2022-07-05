
    <div class="form-group lectureContent-{{$id}}" >
        <label for="content">{{__('web.Lecture-content')}}</label>
        <input type="text" name="course_lectures[{{$index}}][course_lectures_files][{{$id}}][name]" required class="form-control" id="content" placeholder="{{__('web.Add-content-title')}}">
    </div>
    <div class="form-group lectureContent-{{$id}}">
        <div class="content-video">
            <label for="photo-upload" class="custom-file-upload">{{__('web.Update-files')}}</label>
            <input type="url" class="form-control uploadUrl" placeholder="https://www.youtube.com/watch?v=xxxxx"   name="course_lectures[{{$index}}][course_lectures_files][{{$id}}][video]" required >
            <a href="#"    class="add" data-id="{{$index}}" style="color: white"><img src="{{setAsset('website/img/white_plus.png')}}" alt="minus"></a>
            <a href="#"   class=" minusContent" data-id="{{$id}}" style="  right: auto;color: white;left: 50px; background-color: #E13A7E!important;     justify-content: center;
    align-items: center;
    bottom: 15px;
    width: 20px;
    display: flex;
    height: 20px;
    position: absolute;
    border-radius: 5px;
    top: unset;"><img style="height: 1px" src="{{setAsset('website/img/white_minus.png')}}" alt="minus"></a>
        </div>
    </div>


