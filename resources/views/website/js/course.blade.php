
<script type="text/javascript">
    $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
        $(e.target).prev().find("i:last-child").toggleClass("fa-minus fa-plus");
        $(e.target).prev().find("i:last-child").toggleClass("fa-minus fa-plus");
        $(e.target).prev().toggleClass("whiteBg");
        $(e.target).prev().toggleClass("whiteBg");
        $(e.target).prev().find('.headTitle span').toggleClass("bgLightGray");
        $(e.target).prev().find('.headTitle span').toggleClass("bgLightGray");
    });

    $(document).on('click','.expandAll',function () {
        $("#accordion").find("i:last-child").removeClass("fa-plus").addClass('fa-minus');
        $("#accordion").find('.card-header').removeClass("whiteBg");
        $("#accordion").find('.headTitle span').removeClass("bgLightGray");
        $("#accordion").find('.collapse').addClass("show");
        $(this).removeClass('expandAll')
        $(this).addClass('closeAll')
        $(this).text('{{__('closeAll')}}')
    });

    $(document).on('click','.closeAll',function () {
        $("#accordion").find("i:last-child").removeClass("fa-minus").addClass('fa-plus');
        $("#accordion").find('.card-header').addClass("whiteBg");
        $("#accordion").find('.headTitle span').addClass("bgLightGray");
        $("#accordion").find('.collapse').removeClass("show");
        $(this).addClass('expandAll')
        $(this).removeClass('closeAll')
        $(this).text('{{__('expandAll')}}')
    });

    $(document).on('click','#favourite',function (){
        $.ajax({
            type                     : "POST",
            url                      : "{{route('coursati.favourite')}}",
            dataType                 : "json",
            data                     : {
                _token               : '{{csrf_token()}}',
                id                   : $(this).data('id')
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
                    toastr.error(data.msg)
                }
            }
        });
    });
    $(document).on('click','#addToCart',function (e){
        e.preventDefault();
        $.ajax({
            type                     : "POST",
            url                      : "{{route('coursati.addToCart')}}",
            dataType                 : "json",
            data                     : {
                _token               : '{{csrf_token()}}',
                id                   :  $(this).data('id')
            },
            success: function (data) {
                if(data.isFav)
                {
                    $('#addToCart').removeClass('carts')
                    $('#addToCart').addClass('is-cart')
                    $('#addToCart').text('{{__('web.Empty Cart')}}')
                    toastr.success(data.msg)
                }else{
                    $('#addToCart').removeClass('is-cart')
                    $('#addToCart').addClass('carts')
                    $('#addToCart').text('{{__('web.Add to Cart')}}')
                    toastr.error(data.msg)
                }
            }
        });
    });
</script>
