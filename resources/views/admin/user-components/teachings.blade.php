
@php
    $categories = \App\Models\Category::get();
@endphp
<div class="col-sm-12">
    <div class="form-group">
        <select name="experience[{{$index}}][category_id]" class="form-control" required>
            <option value="" selected hidden>{{__('choose_category')}}</option>
            @foreach($categories as$category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
         <input  placeholder="{{__('Experience_years')}}" type="text" name="experience[{{$index}}][experience_years]" class="form-control">
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
         <select name="experience[{{$index}}][experience_level]" class="form-control" required>
            <option value="" selected hidden>{{__('Level_of_Experience')}}</option>
            <option value="junior_level"    >{{__('junior')}}</option>
            <option value="mid_level"    >{{__('Mid')}}</option>
            <option value="advanced_level"    >{{__('Advanced')}}</option>
        </select>
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group">
         <textarea  {{__('about')}} required class="form-control" name="experience[{{$index}}][description]"></textarea>
    </div>
</div>
