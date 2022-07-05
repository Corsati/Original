<div class="row-categories ">
    <div class="d-flex justify-content-between align-items-center">
        <label for="category" class="d-block">{{__('web.select_category')}} <span class="required-span">*</span></label>
        <a class="redBtn deleteBtn deleteField deleteField deleteField">{{__('web.delete_field')}}</a>
    </div>
    <select class="selectpicker w-100" name="experience[{{$index}}][category_id]" id="category"
            title="{{__('web.select')}}" required>
        <option value="" selected hidden>{{__('web.select')}}</option>
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->getTranslation('name', lang())}}</option>
        @endforeach
    </select>
    <div class="rowSpace">
        <div class="form-group">
            <label for="experience">{{__('web.experience_years')}} <span class="required-span">*</span></label>
            <input type="text" class="form-control" name="experience[{{$index}}][experience_years]" id="experience"
                   placeholder="{{__('web.add_years')}}" required>
        </div>
        <div class="form-group experience">
            <label for="level">{{__('web.level_of_experience')}} <span class="required-span">*</span></label>
            <select class="selectpicker w-100" name="experience[{{$index}}][experience_level]" id="level"
                    title="{{__('web.select')}}" required>
                <option value="" selected hidden>{{__('web.select')}}</option>
                @foreach($academics as $academic)
                    <option value="{{$academic->id}}">{{$academic->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group textAreaDiv">
            <label for="desc">{{__('web.short_description')}} <span class="required-span">*</span></label>
            <textarea class="form-control" id="desc" name="experience[{{$index}}][description]" rows="5"
                      placeholder="{{__('web.short_description')}}" required></textarea>
        </div>
        <div class="d-flex align-items-center flex-wrap mt-3 tableCenter">
        </div>
    </div>
</div>
