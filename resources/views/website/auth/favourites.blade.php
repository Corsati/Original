@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <style type="text/css">
        .is-favourite{
            background-color: #e13a7d !important;
            color: #F2F2F2  !important;
        }
        .favourites{
            background-color: #F2F2F2 !important;
            color: #e13a7d  !important;
        }

        .is-cart{
            background-color: #ff7600 !important;
            color: #F2F2F2  !important;
        }
        .carts{
            background-color: #F2F2F2 !important;
            color: #ff7600  !important;
        }
    </style>
    <!--start light gray bg-->
    <div class="lightGrayBg categoryCont favouriteCont pb-2">
        <div class="container">
            <div class="topResult d-flex justify-content-between align-items-center">
                <div class="resultsNum">
                    <h4>{{__('web.favourites')}}</h4>
                    <p>{{__('web.Courses you liked')}}</p>
                </div>
            </div>
            <div class="resultsContainer d-flex justify-content-between mt-0">
                <div class="results w-100 ml-0">
                    <div class="institutesContainer pt-0">
                        <div class="institutes">
                            @foreach( auth()->user()->favourites as $favourite)
                                @php
                                $course = $favourite->course;
                                @endphp
                                @include('website.components.horizontalCourse')
                            @endforeach
                        </div>
                        @if(count(auth()->user()->favourites) == 0)
                            @include('website.components.empty')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end light gray bg-->
    <!--start Popular Instructors-->
    @include('website.layouts.partial.popularInstructor')
    <!--end Popular Instructors-->
    @include('website.layouts.partial.footerDetails')
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).on('click','.favourite',function (){
            var id     = $(this).data('id')
            $.ajax({
                type                     : "POST",
                url                      : "{{route('coursati.favourite')}}",
                dataType                 : "json",
                data                     : {
                    _token               : '{{csrf_token()}}',
                    id                   : id
                },
                success: function (data) {
                    if(data.isFav)
                    {
                        $('#favourite').removeClass('favourites')
                        $('#favourite').addClass('is-favourite')
                        toastr.success(data.msg)
                    }else{
                        $('#favourite').removeClass('is-favourite')
                        $('#favourite').addClass('favourites')
                        $('#item-'+id).remove()
                        toastr.error(data.msg)
                    }
                }
            });
        });

        window.addEventListener( "pageshow", function ( event ) {
            var historyTraversal = event.persisted ||
                ( typeof window.performance != "undefined" &&
                    window.performance.navigation.type === 2 );
            if ( historyTraversal ) {
                // Handle page restore.
                window.location.reload();
            }
        });
    </script>
@endpush
