@extends('website.layouts.master')
@section('content')
{{--    @include('website.layouts.partial.headerDetails')--}}
{{--    @include('website.layouts.partial.navbar')--}}
{{--    @include('website.auth.normalUser.login')--}}
@include('website.layouts.partial.headerDetails')


    <style>
        /*.steps .circleBlock:first-child{*/
        /*    margin-left: 4px;*/
        /*}*/
    </style>
    <div class="content w-78">
        <!--start light gray bg-->
        <div class="lightGrayBg createCourse myFeedBack pb-4">
            <div class="container-sm container-md-none px-md-5 py-md-2 pr-120">
                <div class="d-flex justify-content-between align-items-center mt-4 transformColumn">
                    <div>
                        <h2 class="title mb-2">{{__('web.Create-course')}}</h2>
                        <p class="desc">{{__('web.Create-course-desc')}}</p>
                    </div>

                    <div class="steps d-none d-md-flex">
                        <a class="circleBlock">
                            <span>{{__('web.Course-general-details')}}</span>
                            <div class="orangeCircle">1</div>
                        </a>
                        <a href="{{$course ? url('create-step-two/'.$course->id) :''}}" class="circleBlock">
                            <span>{{__('web.Course-Lectures')}}</span>
                            <div class="grayCircle">2</div>
                        </a>
                        @if($course)
                        <a href="{{ $course->steps == 'two'  || $course->steps == 'three' ? url('create-step-three/'.$course->id) :'#'}}" class="circleBlock">
                            <span>{{__('web.Additional-info')}}</span>
                            <div class="grayCircle">3</div>
                        </a>
                        @else
                            <a href="#" class="circleBlock">
                                <span>{{__('web.Additional-info')}}</span>
                                <div class="grayCircle">3</div>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="accDetails mt-4">
                    <h3 class="title">
                        {{__('web.Course-info')}}
                    </h3>

                    <form  action="{{route('coursati.storeCourse')}}" class="ajaxCourseSubmit" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="category_id" value="{{$id}}">

                        <input type="hidden" name="course_id"   value="{{$course? $course->id :''}}">
                        <div class="form-group">
                            <label for="title">{{__('web.Course-title')}}</label>
                            <input type="text" class="form-control" id="title" value="{{$course ? $course->getTranslation('title',courseLng($course)):'' }}"   name="title"   placeholder="{{__('web.Add-title')}}">
                        </div>

                        <div class="form-group textAreaDiv">
                            <label for="desc">{{__('web.Description')}}</label>
                            <textarea class="form-control" id="description" rows="4"  name="description"   placeholder="{{__('web.Add-Description')}}">{{$course ? $course->getTranslation('description',courseLng($course)):'' }}</textarea>
                        </div>
                        <div class="form-group textAreaDiv ">
                            <label for="fields">{{__('web.tags')}} </label>
                            <select class="selectpicker w-100 category" data-live-search="true" id="fields"  name="categories[]" multiple
                                    title="{{__('web.select_category')}}">
                                @foreach($main as $category)
                                    <option value="{{$category->id}}" {{in_array($category->id,$courseCategories) ? 'selected' :''}}>{{$category->getTranslation('name', lang())}}</option>
                                @endforeach
                            </select>
                        </div>

{{--                        @if($course)--}}
{{--                            <div class="form-group textAreaDiv ">--}}
{{--                                <div class="titles">--}}
{{--                                    @foreach( $course->categories as $courseCategory)--}}
{{--                                        <div id="div1">--}}
{{--                                            <option value="{{$courseCategory->category->id}}">{{$courseCategory->category->getTranslation('name', lang())}}</option>--}}
{{--                                            <a class="deleteCategory deleteTitle" data-id="{{ $courseCategory->category->id }}"--}}
{{--                                               data-token="{{ csrf_token() }}">--}}
{{--                                                <i class="fas fa-times"></i>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}

                        <div class="d-flex align-items-center flex-wrap mb-2">
                            <div class="mr-md-2">
                                <h4 class="title">
                                    {{__('web.Course-image')}}
                                </h4>
                                <p class="mid-hint">{{__('web.dimension_250_150')}}</p>

                                <div class="changeImg" >
                                    <a class="change courseImg">
                                        <img src="{{$course && !is_null($course->image) ? $course->image : setAsset('website/img/plusImg.png')}}" alt="profile" style="margin: 0">
                                        <input class="file-upload courseImgUpload"  accept="image/*"    type="file"  id="image" name="image"  />
                                    </a>

                                </div>
                            </div>

                          </div>

                        <div class="form-group">
                            <label for="title">{{__('web.promotional_video')}}</label>
                            <input type="url" class="form-control" id="promotional_video" value="{{$course ? $course->promotional_video:'' }}"   name="promotional_video"   placeholder="https://www.youtube.com/watch?v=xxxxx">
                        </div>

                        <div class="rowGroup d-flex justify-content-between align-items-center flex-wrap">
                            <div class="form-group">
                                <label for="language">{{__('web.Course-price')}}</label>
                                <select class="selectpicker w-100"  id="price" name="price"  title="{{__('web.Course-price')}}">
                                    <option  {{$course  && $course->price  == 0? 'selected'  :'' }}  value="0"> 0.00  {{__('web.Free')}}</option>
                                    @foreach($prices as $price)
                                        <option  {{$course  && $course->price  ==$price->price? 'selected'  :'' }}  value="{{$price->price}}"> {{$price->price}} {{__('web.SAR')}}  {{__('web.Tier')}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Discount">{{__('web.Discount-percentage')}}</label>
                                <input type="number" min="0" class="form-control" id="Discount" max="100" name="discount" value="{{$course ? $course->discount:'' }}" placeholder="{{__('web.add-percentage')}}">
                                <span class="positionSpan">%</span>
                            </div>
                            <div class="form-group">
                                <label for="language">{{__('web.Course-language')}}</label>
                                <select class="selectpicker w-100" id="language" name="language"   title="{{__('web.select-language')}}">
                                    <option  {{$course  && $course->language  == 'ar'? 'selected'  :'' }}  value="ar">{{__('web.Arabic')}}</option>
                                    <option  {{$course  && $course->language  == 'en' ? 'selected' :'' }}  value="en">{{__('web.English')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                    <label for="language">{{__('web.Course-level')}}</label>
                                    <select class="selectpicker w-100" id="level" name="level"   title="{{__('web.select-level')}}">
                                        <option value="" selected hidden >{{__('choose_level')}}</option>
                                        @foreach($academics as $academic)
                                            <option  {{$course  && $course->level  == $academic->id  ? 'selected' :'' }} value="{{$academic->id}}"     >{{$academic->name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group col-6" >
                                <label for="Discount">{{__('web.total-hours')}}</label>
                                <select class="selectpicker w-100" id="total_hours" name="total_hours"   title="{{__('web.total-hours')}}">
                                    @foreach($durations as $duration)
                                        <option  {{$course  && $course->total_hours  == $duration->id? 'selected'  :'' }}  value="{{$duration->id}}">{{$duration->from}} - {{$duration->to}} {{__('web.Hours')}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <h3 class="title mb-4">
                            {{__('web.Course-Requirements')}}
                        </h3>

                        <h4 class="title">
                            {{__('web.Requirements-title')}}
                        </h4>
                        @if($course)
                            @foreach($course->requirements as $requirement)
                                <div class="form-group">
                                    <input type="text" value="{{$requirement->getTranslation('name',courseLng($course))}}" name="requirements[]" class="form-control"   placeholder="{{__('web.name')}}">
                                </div>
                            @endforeach
                        @endif
                        <div class="form-group">
                            <input type="text"  name="requirements[]" class="form-control"   placeholder="{{__('web.name')}}">
                            <a   id="add-requirements" class="minus"><img src="{{setAsset('website/img/white_plus.png')}}" alt="minus"></a>
                        </div>
                        <div id="more-requirements">

                        </div>



                        <input type="hidden" id="type" name="type" value="">
                        <div class="d-flex align-items-center flex-wrap mt-5 mb-5">
                            @if($course)
                            <input  type="submit" value="{{__('web.Next')}}" data-type="next"  class="orangeBtn purbleClr mr-3 mb-3 mb-md-0" >
                                @else
                            <input  type="submit" value="{{__('web.Next')}}" data-type="next" href="#" class="orangeBtn purbleClr mr-3 mb-3 mb-md-0" >
                            @endif
                            <button type="submit" data-type="later" id="draft" class="orangeBtn" >{{__('web.Save-draft')}}</button>
                        </div>

                    </form>


                </div>

            </div>
        </div>

        <!--end light gray bg-->
@include('website.layouts.partial.footerDashboard')

@endsection

@push('scripts')
    @include('website.js.create-course')
@endpush
