@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.headerDetails')
    <div class="content w-78">
        <!--start light gray bg-->
        <div class="lightGrayBg pb-4">
            <div class="container-sm container-md-none px-md-5 py-md-2 pr-120">

                <div class="performance resources mt-30">
                    <h2 class="title">{{__('web.Resources')}}</h2>
                    <p class="desc">{{__('web.share')}}</p>

                    <div class="coursesContainer mt-4">

                        <a href="#" class="item soon">
                            <img src="{{setAsset('website/img/online-learning.svg')}}" alt="category">
                            <div>
                                <h4>{{__('web.Teaching center')}}</h4>
                                <span>{{__('web.find articles')}}</span>
                            </div>
                        </a>


                        <a href="#" class="item soon">
                            <img src="{{setAsset('website/img/talking.svg')}}" alt="category">
                            <div>
                                <h4>{{__('web.Instructor community')}}</h4>
                                <span>{{__('web.share with')}}</span>
                            </div>
                        </a>

                        <a href="{{route('coursati.contactUs')}}" class="item">
                            <img src="{{setAsset('website/img/computer.svg')}}" alt="category">
                            <div>
                                <h4>{{__('web.Help and support')}}</h4>
                                <span>{{__('web.help support')}}</span>
                            </div>
                        </a>

                    </div>
                </div>


                <!--start have ques-->
                <div class="haveQues mt-5">
                    <h2 class="title">{{__('web.contact')}}</h2>
                    <a href="{{route('coursati.contactUs')}}" class="orangeBtn">{{__('web.Contact us')}}</a>
                </div>
                <!--end have ques-->

            </div>
        </div>
        <!--end light gray bg-->
@include('website.layouts.partial.footerDashboard')
</div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('.soon').on('click', function (){
            swal("{{__('web.soon')}}");
        })
    </script>
@endpush