<div class="row" id="academy-${i}" style="width : 100%;margin: 0;">
    <div class="col-sm-12" >
        <div class="form-group">
             <input placeholder="{{__('title')}}" required type="text" name="academy[{{$index}}][title]" class="form-control">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
             <input required placeholder="{{__('details')}}" type="text" name="academy[{{$index}}][details]" class="form-control">
        </div>
    </div>
    <div class="col-sm-4" >
        <div class="form-group">
             <input required  placeholder="{{__('proof')}}" type = "file" name = "academy[{{$index}}][proof_image]"   class="form-control" id = "image" accept = "image/*" required>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
             <div  class="form-control btn btn-danger deleteBtn" data-id="{{$index}}">-</div>
        </div>
    </div>
</div>
