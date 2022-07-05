@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <!--start light gray bg-->
    <div class="lightGrayBg pb-5">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('coursati.index')}}"><i
                                    class='fas fa-chevron-left'></i>{{__('web.home')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('web.teach_with_us')}}</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="title">{{__('web.teach_with_us')}}</h2>
                    <p class="desc">{{__('web.confirm_msg')}}</p>
                </div>
                <div class="steps d-none d-md-flex orangeLine">
                    <div class="circleBlock qual">
                        <span>{{__('web.account_details')}}</span>
                        <div class="orangeCircle">1</div>
                    </div>
                    <div class="circleBlock">
                        <span>{{__('web.qualifications')}}</span>
                        <div class="orangeCircle">2</div>
                    </div>
                </div>
            </div>

            <div class="alert alert-danger mt-30" role="alert">
                {{ __('web.To proceeding') }}
                {{ __('web.Complete profile') }}
            </div>

            <div class="accDetails">

                <form action="{{route('coursati.storeTeachQualifications')}}" class="ajaxCompleteTeacherSubmit"
                      method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{Auth::id()}}" name="id">
                    <h3 class="title">
                        {{__('web.academic_details')}}
                    </h3>
                    <div class="row-academics">
                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="title">{{__('web.select_title')}} <span class="required-span">*</span></label>
                            </div>
                            <input type="text" class="form-control" name="academy[0][title]" id="title"
                                   placeholder="{{__('web.add_title')}}" required>
                        </div>
                        <div class="rowSpace">
                            <div class="form-group">
                                <label for="details">{{__('web.qualification_skill')}} <span class="required-span">*</span></label>
                                <input type="text" class="form-control" name="academy[0][details]" id="details"
                                       placeholder="{{__('web.add_details')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="photo-upload"
                                       class="custom-file-upload">{{__('web.qualification_proof')}}  </label>
                                <input type="text" class="form-control docPhoto"  placeholder="Browse" disabled>
                                <input    accept="application/pdf, application/vnd.ms-excel , application/octet-stream"  class="uploadFile photo-upload"  name='academy[0][proof_image]' type="file">

                            </div>
{{--                            <div class="form-group"></div>--}}
{{--                            <div class="form-group">--}}
{{--                                <p class="mid-hint">{{__('web.allowed')}}</p>--}}
{{--                            </div>--}}
                        </div>

                    </div>

                    <div class="more_academics">

                    </div>
                    <div class="d-flex align-items-center flex-wrap mt-3">
                        <a class="orangeBtn purbleClr mr-3 mb-3 mb-md-0" id="more_academics">{{__('web.add_more')}}</a>
                    </div>
                    <div class="d-flex align-items-center flex-wrap mt-3">
                    </div>
                    <h3 class="title">
                        {{__('web.teaching_categories')}}
                    </h3>
                    <div class="row-categories">
                        <div class="form-group categoryForm">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="category" class="d-block">{{__('web.select_category')}} <span class="required-span">*</span></label>
{{--                                <a class="deleteBtn deleteField">{{__('web.delete_field')}}</a>--}}
                            </div>
                            <select class="selectpicker w-100" name="experience[0][category_id]" id="category"
                                    title="{{__('web.select')}}"  data-live-search="true"  required>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->getTranslation('name', lang())}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="rowSpace">
                            <div class="form-group">
                                <label for="experience">{{__('web.experience_years')}} <span class="required-span">*</span></label>
                                <input type="text" class="form-control" name="experience[0][experience_years]"
                                       id="experience" placeholder="{{__('web.add_years')}}" required>
                            </div>

                            <div class="form-group experience">
                                <label for="level">{{__('web.level_of_experience')}} <span class="required-span">*</span></label>
                                <select class="selectpicker w-100" name="experience[0][experience_level]" id="level"
                                        title="{{__('web.select')}}" required>
                                    <option value="" selected hidden>{{__('web.select')}}</option>
                                    @foreach($academics as $academic)
                                        <option value="{{$academic->id}}">{{$academic->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group textAreaDiv">
                                <label for="desc">{{__('web.short_description')}} <span class="required-span">*</span></label>
                                <textarea class="form-control" id="desc" name="experience[0][description]" rows="5"
                                          placeholder="{{__('web.short_description')}}" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="more_Teaching_Categories pb-3 pt-3"></div>
                    <div class="d-flex align-items-center flex-wrap mt-3">
                        <a class="orangeBtn purbleClr mr-3 mb-3 mb-md-0"
                           id="more_Teaching_Categories">{{__('web.add_more')}}</a>
                        <button type="submit" class="orangeBtn" id="signUpModal">{{__('web.save_changes')}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!--end light gray bg-->

    @include('website.layouts.partial.footerDetails')

@endsection
@push('scripts')
    @include('website.js.teachQualifications')
@endpush
