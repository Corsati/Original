<div id="academy-${index}" class="row-academics">
    <div class="form-group">
        <div class="d-flex justify-content-between align-items-center">
            <label for="title">{{__('web.select_title')}} <span class="required-span">*</span></label>
            <a class="deleteBtn deleteField">{{__('web.delete_field')}}</a>
        </div>
        <input type="text" class="form-control" name='academy[{{$index}}][title]' id="title" placeholder="{{__('web.add_title')}}" required>
    </div>

    <div class="rowSpace">
        <div class="form-group">
            <label for="details">{{__('web.qualification_skill')}} <span class="required-span">*</span></label>
            <input type="text" class="form-control" name="academy[{{$index}}][details]" id="details" placeholder="{{__('web.add_details')}}" required>
        </div>
        <div class="form-group">
            <label for="photo-upload" class="custom-file-upload">{{__('web.qualification_proof')}} </label>
            <input type="text" class="form-control docPhoto"   placeholder="Browse" disabled>
            <input accept="application/pdf, application/vnd.ms-excel ,  application/octet-stream" class="uploadFile photo-upload" name='academy[{{$index}}][proof_image]' type="file">
        </div>
    </div>

</div>
