{{--<div class="form-group mb-1">--}}
{{--    <label for="testTitle">{{__('web.Title')}}</label>--}}
{{--    <input type="text" class="form-control" name="certificates[{{$id}}][title]"   placeholder="{{__('web.Add-c-title')}}">--}}
{{--</div>--}}
<div class="rowSpace mt-0">
    <div class="form-group">
        <label for="taskDesc">{{__('web.Task-description')}}</label>
        <input type="text" class="form-control"  name="certificates[{{$id}}][details]"   placeholder="{{__('web.Add-description')}}">
    </div>
    <div class="form-group">
        <label for="photo-upload" class="custom-file-upload">{{__('web.Task-files')}} </label>
        <input type="text" class="form-control plusInput docPhoto" id="docPhoto" placeholder="{{__('web.Task-files')}}" disabled>

        <input id="photo-upload" accept="application/pdf,application/vnd.ms-excel" class="uploadFile photo-upload" name="certificates[{{$id}}][files]" type="file">

{{--        <a href="" class="add"><img src="{{setAsset('website/img/white_plus.png')}}" alt="add"></a>--}}
    </div>
</div>
