@extends('website.layouts.master')
@section('content')
{{--    @include('website.layouts.partial.headerDetails')--}}
{{--    @include('website.layouts.partial.navbar')--}}
{{--    @include('website.auth.normalUser.login')--}}
@include('website.layouts.partial.headerDetails')

    <style>
        .steps .circleBlock:first-child{margin-left: 4px;}
        .content-pdf{
            display: none;
        }
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

                    <div class="steps step2 d-none d-md-flex">
                        <a href="{{url('create-course/'.$categoryId.'/'.'edit'.'/'.$id)}}" class="circleBlock">
                            <span>{{__('web.Course-general-details')}}</span>
                            <div class="orangeCircle">1</div>
                        </a>
                        <a class="circleBlock">
                            <span>{{__('web.Course-Lectures')}}</span>
                            <div class="orangeCircle">2</div>
                        </a>
                        <a href="{{ $course->steps == 'two' ? url('create-step-three/'.$id) :'#'}}" class="circleBlock">
                            <span>{{__('web.Additional-info')}}</span>
                            <div class="grayCircle">3</div>
                        </a>
                    </div>
                </div>

                <div class="accDetails mt-4">
                    <h3 class="title mb-2">
                        {{__('web.courseContent')}}
                    </h3>

                    <form action="{{route('coursati.storeCourseTwo')}}" method="post" id="myFormId" class="ajaxStepTwoSubmit">
                        @csrf
                        <input type="hidden" name="course_id" value="{{$id}}">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <h3 class="title m-0">
                                {{__('web.Lecture')}}
                            </h3>
                        </div>
                        <div class="formGroupCont">
                            <div class="lectureContainer">
                                <div class="form-group">
                                    <label for="title">  {{__('web.Lecture-title')}}</label>
                                    <input type="text" name="course_lectures[0][title]" class="form-control"              {{count($course->lectures) == 0 ? 'required':'' }} id="title" placeholder=" {{__('web.title-lecture')}}">
                                </div>
                                <!--
                                <div class="form-group countryForm">
                                    <select  style="    border: 1px solid #ddd;" class="city  w-100 file_type"  name="course_lectures[0][course_lectures_files][0][content_file_type]"  id="file_type">
                                        <option value=""  hidden>{{__('web.fileType')}}</option>
                                        <option selected value="video">{{__('web.Video')}}</option>
                                        <option value="pdf">{{__('web.PDF')}}</option>
                                    </select>
                                </div>
                                -->
                                <div class="rowSpace mt-0">
                                    <div class="form-group">
                                            <label for="content">{{__('web.Lecture-content')}}</label>
                                            <input type="text" name="course_lectures[0][course_lectures_files][0][name]"  {{count($course->lectures)  == 0? 'required':'' }} class="form-control" id="content" placeholder="{{__('web.Add-content-title')}}">
                                     </div>
                                    <div class="form-group"  >
                                        <div class="content-video">
                                         <label for="photo-upload" class="custom-file-upload">{{__('web.Update-files')}}</label>
                                         <input type="url"  placeholder="https://www.youtube.com/watch?v=xxxxx"  class="form-control" name="course_lectures[0][course_lectures_files][0][video]" {{count($course->lectures)== 0 ? 'required':'' }}>
                                         <a href="#" data-id="0"   class="add" style="color: white"><img src="{{setAsset('website/img/white_plus.png')}}" alt="minus"></a>
                                        </div>
{{--                                        <div class="content-pdf">--}}
{{--                                            <label for="photo-upload" class="custom-file-upload">{{__('web.Lecture-content')}}</label>--}}
{{--                                            <input type="file" class="form-control"    name="course_lectures[0][course_lectures_files][0][video]" id="docPhoto" placeholder="Browse" >--}}
{{--                                            <input id="photo-upload" class="uploadFile"   type="file"  >--}}
{{--                                        </div>--}}
                                    </div>


                                </div>
                            </div>
                        </div>

                        @foreach($course->lectures as $lecture)
                            @php
                            $rand  = rand(1111,999);
                            @endphp
                            <div class="formGroupCont">
                                <div class="lectureContainer">
                                    <div class="form-group">
                                        <label for="title">  {{__('web.Lecture-title')}}</label>
                                        <input type="text"  value="{{$lecture->getTranslation('name',courseLng($course))}}" name="course_lectures[{{$rand}}][title]" class="form-control" id="title" placeholder=" {{__('web.title-lecture')}}">
                                        <a href="#"  id=""  class="minus" ><img src="{{setAsset('website/img/white_minus.png')}}" alt="minus"></a>
                                    </div>
                                    @foreach($lecture->lectureFiles as $lectureFile)
                                        @php
                                            $rand2  = rand(1111,999);
                                        @endphp
                                    <div class="rowSpace mt-0">
                                        <div class="form-group">
                                            <label for="content">{{__('web.Lecture-content')}}</label>
                                            <input type="text"  value="{{$lectureFile->getTranslation('name',courseLng($course))}}"  name="course_lectures[{{$rand}}][course_lectures_files][{{$rand2}}][name]" required class="form-control" id="content" placeholder="{{__('web.Add-content-title')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="photo-upload" class="custom-file-upload">{{__('web.Update-files')}}</label>
                                            <input type="url" value="{{$lectureFile->file}}"  placeholder="https://www.youtube.com/watch?v=xxxxx" name="course_lectures[{{$rand}}][course_lectures_files][{{$rand2}}][video]" class="form-control" required  >
                                            <a href="#" data-id="{{$rand}}"   class="add" style="color: white"><img src="{{setAsset('website/img/white_plus.png')}}" alt="minus"></a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        <div id="lectures">
                        </div>
                        <a class="addMoreLec" id="addMoreLec" ><img src="{{setAsset('website/img/plus.png')}}" class="mr-2" alt="add">{{__('web.add-more-lectures')}}</a>
                        <input type="hidden" name="type" id="type">
                        <div class="d-flex align-items-center flex-wrap mb-5">
                            <input  type="submit" value="{{__('web.Next')}}" data-type="next" href="#" class="orangeBtn purbleClr mr-3 mb-3 mb-md-0" >
                            <button type="submit" id="draft" class="orangeBtn"  >{{__('web.Save-draft')}}</button>
                        </div>

                    </form>


                </div>

            </div>
        </div>
        <!--end light gray bg-->
@include('website.layouts.partial.footerDashboard')
@endsection

 @push('scripts')
     @include('website.js.createStepTwo')
@endpush
