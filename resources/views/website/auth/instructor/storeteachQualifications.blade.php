@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    <!--start light gray bg-->
    <div class="lightGrayBg pb-5">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('coursati.comingSoon')}}"><i class='fas fa-chevron-left'></i>Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Teach with us</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="title">Teach with us</h2>
                    <p class="desc">Please complete the form so you can upload courses and trainings</p>
                </div>

                <div class="steps d-none d-md-flex orangeLine">
                    <div class="circleBlock qual">
                        <span>Account details</span>
                        <div class="orangeCircle">1</div>
                    </div>
                    <div class="circleBlock">
                        <span>Qualifications</span>
                        <div class="orangeCircle">2</div>
                    </div>
                </div>
            </div>

            <div class="accDetails">

                <form action="{{route('coursati.storeTeachQualifications')}}" class="ajaxSubmit" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{Auth::id()}}" name="id">
                    <h3 class="title">
                        ACADEMIC & PROFESSIONAL DETAILS
                    </h3>
                    <div class="form-group">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="title">Select title</label>
                        </div>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Add title">
                    </div>

                    <div class="rowSpace">
                        <div class="form-group">
                            <label for="details">About the qualification skill</label>
                            <input type="text" class="form-control" name="details" id="details" placeholder="Add details">
                        </div>

                        <div class="form-group">
                            <label for="photo-upload" class="custom-file-upload">Qualification proof ( optional )</label>
                            <input type="text" class="form-control plusInput" id="docPhoto" placeholder="Browse" disabled>
                            <input id="photo-upload" class="uploadFile" name='proof_image' type="file">

                        </div>

                    </div>

                    <h3 class="title">
                        Teaching categories
                    </h3>

                    <div class="form-group categoryForm">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="category" class="d-block">Select category</label>
                        </div>
                        <select class="selectpicker w-100" name="category_id" id="category" title="Select">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->getTranslation('name', 'en')}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="rowSpace">
                        <div class="form-group">
                            <label for="experience">Experience years</label>
                            <input type="text" class="form-control" name="experience_years" id="experience" placeholder="Add years">
                        </div>

                        <div class="form-group experience">
                            <label for="level">Level of Experience</label>
                            <select class="selectpicker w-100" name="experience_level" id="level" title="Select">
                                <option value="" selected hidden>Select</option>
                                <option value="junior_level">Junior</option>
                                <option value="mid_level">Mid-Level</option>
                                <option value="advanced_level">Advanced</option>
                            </select>
                        </div>

                        <div class="form-group textAreaDiv">
                            <label for="desc">Short Description</label>
                            <textarea class="form-control" id="desc" name="description" rows="5" placeholder="Add Short Description"></textarea>
                        </div>
                    </div>
                    <div class="more_Teaching_Categories pb-3 pt-3"></div>
                    <div class="d-flex align-items-center flex-wrap mt-3">
                        <a class="orangeBtn purbleClr mr-3 mb-3 mb-md-0" id="more_Teaching_Categories" >Add more</a>
                        <button type="submit" class="orangeBtn" id="signUpModal">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!--end light gray bg-->
    @include('website.layouts.partial.footerDetails')
@endsection
@push('scripts')
    @include('website.js.storeteachQualifications')
@endpush
