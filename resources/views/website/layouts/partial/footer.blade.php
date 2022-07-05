<!-- start scroll-top-->
<div id="scroll-top" class="text-center">
    <i class="fas fa-angle-up"></i>
</div>

<link href="{!! setAsset('website/css/bootstrap-select.min.css') !!}" rel="stylesheet"/>
<link href="{!! setAsset('website/css/owl.carousel.css') !!}" rel="stylesheet"/>
<link href="{!! setAsset('website/css/slick.css') !!}" rel="stylesheet"/>
<link href="{!! setAsset('website/css/hover.css') !!}" rel="stylesheet"/>
<link href="{!! setAsset('website/css/animate.css') !!}" rel="stylesheet"/>
<link href="{!! setAsset('website/css/extra.css') !!}" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"  />
<link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@1,600&display=swap" rel="stylesheet">
@if(App::getLocale() == 'ar')
    <link href="{{setAsset('website/css/styleRTL.css')}}" rel="stylesheet" />
    <link href="{!! setAsset('website/css/extraAr.css') !!}" rel="stylesheet"/>
@endif
<link href="https://corsati.online/public/dist/css/bootstrap-datetimepicker.css?v2" rel="stylesheet" />

<!-- end scroll-top-->
<script src="{{setAsset('website/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{setAsset('website/js/jQuery.loadScroll.js')}}"></script>
<script src="{{setAsset('website/js/owl.carousel.min.js')}}"></script>
<script src="{{setAsset('website/js/wow.min.js')}}"></script>
<script src="{{setAsset('website/js/scripts.js')}}"></script>
<script src="{{setAsset('website/js/slick.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>-->

<!-- Latest compiled and minified CSS -->
<script>
    new WOW().init();

    $('#signUpModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
    })
    $(document).ready(function(){

        $( ".courses_search" ).autocomplete({
            source: function( request, response ) {
                // Fetch data
                $.ajax({
                    url:"{{route('coursati.autocomplete')}}",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: '{{csrf_token()}}',
                        search: request.term
                    },
                    success: function( data ) {
                        //response( data );
                        response($.map(data, function(objet){
                            return {
                                label: objet.label,
                                value: objet.id
                            };
                        }));
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                console.log(ui)
                $('.courses_search').val(ui.item.label);
                return false;
            }
        });

    });
</script>



@if(Session::has('success'))
    <script>
        toastr.success('{{ Session::get('success') }}');
    </script>

@elseif(Session::has('danger'))
    <script>
        toastr.error('{{ Session::get('danger') }}');
    </script>
@endif
@if (count($errors) > 0)
    <script>
        @foreach(array_reverse($errors->all()) as $error)
        toastr.error('{{$error}}');
        @endforeach
    </script>
@endif

@if (session()->has('code') && session()->get('code') == 'reset')
    <script>
        $(document).ready(function(){
            $("#loginModal").modal();
        });
    </script>
@endif

@include('website.components.javascript')
