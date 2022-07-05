@extends('website.layouts.master')
@section('content')
{{--    @include('website.layouts.partial.headerDetails')--}}
{{--    @include('website.layouts.partial.navbar')--}}
{{--    @include('website.auth.normalUser.login')--}}
@include('website.layouts.partial.headerDetails')

    <style>
        .steps .circleBlock:first-child {
            margin-left: 4px;
        }
        .image-upload>input {
            display: none;
        }
    </style>
    <div class="content w-78">
        <!--start light gray bg-->
        <div class="lightGrayBg createCourse myFeedBack pb-4">
            <div class="container-sm container-md-none px-md-5 py-md-2 pr-120">
                <div class="d-flex justify-content-between align-items-center mt-4  transformColumn">
                    <div>
                        <h2 class="title mb-2">{{__('web.Create-course')}}</h2>
                        <p class="desc">{{__('web.Create-course-desc')}}</p>
                    </div>
                    <div class="steps step2 d-none d-md-flex">
                        <a href="{{url('create-course/'.$categoryId.'/'.'edit'.'/'.$id)}}" class="circleBlock">
                            <span>{{__('web.Course-general-details')}}</span>
                            <div class="orangeCircle">1</div>
                        </a>
                        <a href="{{url('create-step-two/'.$id)}}" class="circleBlock orangeLine">
                            <span>{{__('web.Course-Lectures')}}</span>
                            <div class="orangeCircle">2</div>
                        </a>
                        <a class="circleBlock">
                            <span>{{__('web.Additional-info')}}</span>
                            <div class="orangeCircle">3</div>
                        </a>
                    </div>
                </div>
                <div class="accDetails mt-4">
                    <h3 class="title mb-2">
                        {{__('web.watchers-will-learn')}}
                    </h3>
                    <form class="ajaxSubmits" action="{{route('coursati.storeStepThree')}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course_id" value="{{$id}}">
                        <input type="hidden" name="steps" id="steps" value="three">
                        <label for="benefits">{{__('web.Add-benefits')}}</label>

                        @foreach($course->benefits as $benefits)
                            <div class="form-group mb-2">
                                <input value="{{$benefits->getTranslation('name',courseLng($course))}}" required type="text" class="form-control" name="benefits[]"
                                        placeholder="{{__('web.Add-benefits')}}">
                                <a href="#"  data-id="{{$benefits->id}}"  class="minus" ><img src="{{setAsset('website/img/white_minus.png')}}" alt="minus"></a>

                            </div>
                        @endforeach
                        <div class="form-group mb-2">
                            <input  {{count($course->benefits) == 0 ? 'required' : ''}} type="text" class="form-control" name="benefits[]"
                                    placeholder="{{__('web.Add-benefits')}}">

                        </div>
                        <div id="more-benefits"></div>
                        <a id="addBenefits"  style="color:#fa7500;" class="addMoreLec mt-0"><img src="{{setAsset('website/img/plus.png')}}"
                                                                         class="mr-2" alt="add">{{__('web.add-more')}}
                        </a>
                        <h3 class="title mb-4">
                            {{__('web.Course-contents')}}
                        </h3>
                        @foreach($course->contents as $contents)
                            <div class="form-group mb-1">
                                <input required  value="{{$contents->getTranslation('name',courseLng($course))}}" type="text" name="contents[]" class="form-control"
                                       placeholder="{{__('web.Add-c-title')}}">
                                <a href="#"  data-id="{{$contents->id}}"  class="minus" ><img src="{{setAsset('website/img/white_minus.png')}}" alt="minus"></a>
                            </div>
                        @endforeach

                        <div class="form-group mb-1">
                            <input {{count($course->contents) == 0 ? 'required' : ''}}  type="text" name="contents[]" class="form-control"
                                   placeholder="{{__('web.Add-c-title')}}">
                        </div>
                        <div id="more-contents"></div>
                        <a id="addContents"   style="color:#fa7500;" class="addMoreLec mt-0"><img src="{{setAsset('website/img/plus.png')}}"
                                                                         class="mr-2" alt="add">{{__('web.add-more')}}
                        </a>

                        <h3 class="title mb-4">
                            {{__('web.Completion-certificate')}}
                        </h3>
{{--                        <div class="form-group mb-1">--}}
{{--                            <label for="testTitle">{{__('web.Title')}}</label>--}}
{{--                            <input {{count($course->benefits) == 0 ? 'required' : ''}} type="text" class="form-control" name="certificates[0][title]"--}}
{{--                                   placeholder="{{__('web.Add-c-title')}}">--}}
{{--                        </div>--}}
                        <div class="rowSpace mt-0">
                            <div class="form-group">
                                <label for="taskDesc">{{__('web.Task-description')}}</label>
                                <input  {{count($course->benefits) == 0 ? 'required' : ''}} maxlength="80" type="text" class="form-control" name="certificates[0][details]"
                                       placeholder="{{__('web.Add-description')}}">
                            </div>
                            <div class="form-group">
                                <label for="photo-upload" class="custom-file-upload">{{__('web.Task-files')}} </label>

                                <input   {{count($course->benefits) == 0 ? 'required' : ''}}  type="text" class="form-control docPhoto"  placeholder="{{__('web.Task-files')}}" disabled>


                                <input id="photo-upload"    accept="application/pdf,application/vnd.ms-excel" class="uploadFile photo-upload"  name="certificates[0][files]" type="file">
                            </div>
                        </div>

                        <div id="more-certificates">
                        </div>
                        <a id="addCertificates"    style="color:#fa7500;" class="addMoreLec mt-0"><img
                                src="{{setAsset('website/img/plus.png')}}"    class="mr-2"
                                alt="add">{{__('web.add-more')}}</a>


                        @if($course)
                            @foreach($course->certificates as $certificate)
                                <div style="display: flex;justify-content: space-around; margin: 20px;border-bottom: 0.02px solid #bbb;border-radius: 5px;padding: 10px;">
                                   <!--<p>{{$certificate->getTranslation('title',$course->language)}}</p>-->
                                    <p style="line-height: 2em;" class="col-6">{{$certificate->getTranslation('details',$course->language)}}</p>
                                    <a href="{{$certificate->file}}" target="_blank" class="col-3"><span style="color: #FF7600" class="fa fa-eye"></span></a>
                                    <a href="{{route('coursati.deleteCertificate',['id' => $certificate->id])}}" class="image-upload col-3">
                                        <i class="fas fa-trash" style="font-size: 16px;line-height: 2em;color: #E13A7E"></i>
                                    </a>
                                </div>
                            @endforeach
                        @endif
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
    @include('website.js.createStepThree')
@endpush

