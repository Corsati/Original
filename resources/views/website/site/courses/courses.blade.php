@extends('website.layouts.master')
@section('content')

    @include('website.layouts.partial.headerDetails')

    <div class="content w-78">
        <!--start light gray bg-->
        <div class="lightGrayBg myCoursesTabs categoryCont pb-4">
            <div class="container-sm container-md-none px-md-5 py-md-2 pr-120">
                <div class="courseContent">
                    <h2 class="title mb-2">{{__('web.Course management')}}</h2>
                    <p class="desc mb-4">{{__('web.You can management')}}</p>

                    <div class="courseTabs">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <nav>
                                <div class="nav nav-tabs mb-0" id="nav-tab" role="tablist">
                                    <a class="nav-link active" id="nav-Active-tab" data-toggle="tab" href="#nav-Active" role="tab" aria-controls="nav-Active" aria-selected="true">{{__('web.Active')}} ({{convertNumbers(auth()->user()->courses()->where('status','active')->count())}})</a>
                                    <a class="nav-link" id="nav-review-tab" data-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-review" aria-selected="false">{{__('web.In review')}}  ({{convertNumbers(auth()->user()->courses()->where('status','in_review')->count())}})</a>
                                    <a class="nav-link" id="nav-Pending-tab" data-toggle="tab" href="#nav-Pending" role="tab" aria-controls="nav-Pending" aria-selected="false">{{__('web.Pending')}}  ({{convertNumbers(auth()->user()->courses()->where('status','pending')->count())}})</a>
                                </div>
                            </nav>

                            <div class="topResult d-flex justify-content-between align-items-center ">

                                <div class="filterBtns d-flex justify-content-center align-items-center">
                                    <a class="listMenuTeacher mr-3 d-none d-xl-flex" href="">
                                        <img src="{{setAsset('website/img/gray_grid.svg')}}" alt="list">
                                    </a>
                                    <a class="gridMenuTeacher d-none d-xl-flex" href="">
                                        <img src="{{setAsset('website/img/black_menu.svg')}}" alt="grid list">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-Active" role="tabpanel" aria-labelledby="nav-Active-tab">
                                <div class="resultsContainer d-flex justify-content-between mt-0">
                                    <div class="results ml-0">
                                        <div class="institutesContainer pt-0">
                                            <div class="institutes mt-0">

                                                @foreach(auth()->user()->courses()->where('status','active')->get() as $course)
                                                <div class="d-flex flex-column mb-3 tabCourse">
                                                    @include('website.components.horizontalCourse')
                                                    <div class="btns d-flex align-items-center">
                                                        <a href="{{url('create-course/'.$course->category_id.'/edit/'.$course->id.'')}}" class="edit mr-2"><img src="{{setAsset('website/img/edit.png')}}" class="mr-2" alt="Edit">{{__('web.Edit')}}</a>
                                                        <a class="cancel mr-2 deleteCourse" href="{{route('coursati.deleteCourse',['id' => $course->id])}}"><img src="{{setAsset('website/img/black_cancel.png')}}" class="mr-2 deleteCourse" alt="Cancel">{{__('web.Cancel')}}</a>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="bottomNav">

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                                <div class="resultsContainer d-flex justify-content-between mt-0">
                                    <div class="results ml-0">
                                        <div class="institutesContainer pt-0">
                                            <div class="institutes mt-0">
                                                @foreach(auth()->user()->courses()->where('status','in_review')->get() as $course)
                                                    <div class="d-flex flex-column mb-3 tabCourse">
                                                        @include('website.components.horizontalCourse')

                                                        <div class="btns d-flex align-items-center">
                                                            <a href="{{url('create-course/'.$course->category_id.'/edit/'.$course->id.'')}}" class="edit mr-2"><img src="{{setAsset('website/img/edit.png')}}" class="mr-2" alt="Edit">{{__('web.Edit')}}</a>
                                                            <a class="cancel mr-2 deleteCourse" href="{{route('coursati.deleteCourse',['id' => $course->id])}}"><img src="{{setAsset('website/img/black_cancel.png')}}" class="mr-2 deleteCourse" alt="Cancel">{{__('web.Cancel')}}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="bottomNav">

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-Pending" role="tabpanel" aria-labelledby="nav-Pending-tab">
                                <div class="resultsContainer d-flex justify-content-between mt-0">
                                    <div class="results ml-0">
                                        <div class="institutesContainer pt-0">
                                            <div class="institutes mt-0">
                                                @foreach(auth()->user()->courses()->where('status','pending')->get() as $course)
                                                    <div class="d-flex flex-column mb-3 tabCourse">
                                                        @include('website.components.horizontalCourse')
                                                        <div class="btns d-flex align-items-center">
                                                            <a href="{{url('create-course/'.$course->category_id.'/edit/'.$course->id.'')}}" class="edit mr-2"><img src="{{setAsset('website/img/edit.png')}}" class="mr-2" alt="Edit">{{__('web.Edit')}}</a>
                                                            <a class="cancel mr-2 deleteCourse" href="{{route('coursati.deleteCourse',['id' => $course->id])}}"><img src="{{setAsset('website/img/black_cancel.png')}}" class="mr-2 deleteCourse" alt="Cancel">{{__('web.delete')}}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="bottomNav">

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        <!--end light gray bg-->
        @include('website.layouts.partial.footerDashboard')
    </div>
    </div>
@endsection

@push('scripts')
    @include('website.js.courses')
@endpush
