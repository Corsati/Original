<div class="row">
    <div class="col-sm-10" >
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="benefits[{{$index}}][name_ar]"  required placeholder="{{__('Add_ar')}}" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="benefits[{{$index}}][name_en]" required placeholder="{{__('Add_en')}}" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <div class="btn btn-danger width_100 botner" id="remove-benefits">-</div>
        </div>
    </div>
</div>
