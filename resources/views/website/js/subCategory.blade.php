<script type="text/javascript">


    var options          = {
        dots: false,
        nav: true,
        navText: [
            "<i class='fas fa-chevron-left'></i>",
            "<i class='fas fa-chevron-right'></i>"
        ],
        autoplay: true,
        loop: false,
        animateOut: 'fadeOut',
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 4,
            },
        }
    };


    jQuery(window).on("load", function(){
        $.ajax({
            type                     : "POST",
            url                      : "{{route('coursati.popularCourses')}}",
            dataType                 : "json",
            data                     : {
                id                   : '{{$category->id}}',
                _token               : '{{csrf_token()}}'
            },
            success: function (data) {
                $('#owl-demo6')      .html(data);
                $.ajax({
                    type             : "POST",
                    url              : "{{route('coursati.bestCourses')}}",
                    dataType         : "json",
                    data: {
                        id           : '{{$category->id}}',
                        _token       : '{{csrf_token()}}'
                    },
                    success: function (data) {
                        $('#owl-demo2').html(data);

                        var $owls     = $('#owl-demo2');
                        $owls.trigger('destroy.owl.carousel');
                        $owls.html($owls.find('.owl-stage-outer').html()).removeClass('owl-loaded');
                        $owls.owlCarousel(options);

                        /*$.ajax({
                            type             : "GET",
                            url              : "{{route('coursati.category-courses')}}",
                            dataType         : "json",
                            data: {
                                id           : '{{$category->id}}',
                                type         : 'subcategory',
                                _token       : '{{csrf_token()}}'
                            },
                            success: function (data) {
                                $('#allCourses').html(data);
                            }
                        });
                        */


                    }
                });
                var $owl              = $('#owl-demo6');
                $owl.trigger('destroy.owl.carousel');
                $owl.html($owl.find('.owl-stage-outer').html()).removeClass('owl-loaded');
                $owl.owlCarousel(options);
            }
        });

    });
    $(document).on('click','.popularFilter', function(){
        $.ajax({
            type                     : "POST",
            url                      : "{{route('coursati.coursesByLevel')}}",
            dataType                 : "json",
            data                     : {
                levels               :  $(this).data('id'),
                _token               : '{{csrf_token()}}'
            },
            success: function (data) {
                $('#owl-demo6')     .html(data);

                var $owl            = $('.owl-carousel');
                $owl.trigger('destroy.owl.carousel');
                $owl.html($owl.find('.owl-stage-outer').html()).removeClass('owl-loaded');
                $owl.owlCarousel({
                    dots: false,
                    nav: true,
                    navText: [
                        "<i class='fas fa-chevron-left'></i>",
                        "<i class='fas fa-chevron-right'></i>"
                    ],
                    autoplay: true,
                    loop: false,
                    animateOut: 'fadeOut',
                    responsive: {
                        0: {
                            items: 1,
                        },
                        768: {
                            items: 2,
                            // center: false
                        },
                        992: {
                            items: 4,
                        },
                    }
                });
            }
        });

    });


    $(document).on('change','#rating,#videoDuration',function (){
        $.ajax({
            type                     : "POST",
            url                      : "{{route('coursati.category-courses')}}",
            dataType                 : "json",
            data                     : {
                id                   : '{{$category->id}}',
                rate                 : $('#rating').val(),
                total_hours          : $('#videoDuration').val(),
                type                 : 'subcategory',
                _token               : '{{csrf_token()}}'
            },
            success: function (data) {
                $('#allCourses').html(data);
            }
        });
    });

</script>
