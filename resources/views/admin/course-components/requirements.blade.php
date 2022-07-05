<div class="row">
    <div class="col-sm-10" >
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" required name="requirements[{{$index}}][name_ar]" placeholder="{{__('Add_ar')}}" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text"  required name="requirements[{{$index}}][name_en]" placeholder="{{__('Add_en')}}" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <div class="btn btn-danger width_100 botner" id="remove-requirements">-</div>
        </div>
    </div>
</div>
