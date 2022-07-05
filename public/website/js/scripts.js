$(document).ready(function () {

    // category active link
    $(".categoriesLinks li a").click(function () {
        $(this).parent().addClass("active").siblings().removeClass("active");
    });


    // grid view
    $(".listMenu").click(function () {
        $('.categoryCont .resultsContainer .results .institutesContainer .institutes .courserBlock').removeClass("w-49");
        event.preventDefault();
    });
    $(".gridMenu").click(function () {
        $('.categoryCont .resultsContainer .results .institutesContainer .institutes .courserBlock').addClass("w-49");
        event.preventDefault();
    });
    // grid view
    $(".listMenuCer").click(function () {
        $('.categoryCont .resultsContainer .results .institutesContainer .institutes .media').removeClass("w-49");
        event.preventDefault();
    });
    $(".gridMenuCer").click(function () {
        $('.categoryCont .resultsContainer .results .institutesContainer .institutes .media').addClass("w-49");
        event.preventDefault();
    });
    // grid view
    $(".listMenuTeacher").click(function () {
        $('.categoryCont .resultsContainer .results .institutesContainer .institutes .tabCourse').removeClass("w-49");
        event.preventDefault();
    });
    $(".gridMenuTeacher").click(function () {
        $('.categoryCont .resultsContainer .results .institutesContainer .institutes .tabCourse').addClass("w-49");
        event.preventDefault();
    });

    // toggle menu
    $("header .toggle").click(function () {
        $(".overlay").css({
            "transform": "scaleX(1)"
        });

        $(".menu").addClass('ulDir');

    });

    $("header .overlay").click(function () {
        $(this).removeAttr("style");
        $(".menu").removeClass("ulDir");
    });

    // toggle dashboard menu

    $("header .toggleSideMenu").click(function () {
        $(".teacherCotent .sideMenu").toggleClass('ulDir');
        $(".content").toggleClass('w-78 w-100');

    });

    // toggle mobile search
    $(".toggleSearch").click(function () {
        $('.mobileSearch').toggleClass( 'd-flex');
        $('.mobileSearch input').focus();
        event.preventDefault();
    });


    // delete course item
    $(".deleteItem").click(function () {
        $(this).parent().parent().remove();
        event.preventDefault();
    });

    // carousal

    $('.courses').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        vertical: true,
        verticalSwiping: true,
        prevArrow:"<i class='fas fa-chevron-up'></i>",
        nextArrow:"<i class='fas fa-chevron-down'></i>",
        infinite:true

    });

    $( '#owl-demo2 , #owl-demo3 , #owl-demo4 , #owl-demo1' ).owlCarousel({
        // center: true,
        dots: false,
        nav: true,
        navText: [
            "<i class='fas fa-chevron-left'></i>",
            "<i class='fas fa-chevron-right'></i>"
        ],
        autoplay: true,
        loop: true,
        animateOut: 'fadeOut',
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 3,
                // center: false
            },
            992: {
                items: 5,
            },
            1200: {
                items: 6
            }
        }
    });

    $('#owl-demo5 , #owl-demo6 , #owl-demo7').owlCarousel({
        // center: true,
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

    // lang selector

    $(function(){
        $('.selectpicker').selectpicker();
    });

    // upload image
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.changeImg img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".file-upload").on('change', function(){
        readURL(this);
    });


    var readURLCourse = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.createCourse .changeImg img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);

        }
    }


    $(".courseImgUpload").on('courseImg', function(){
        readURLCourse(this);
    });

    // upload documentation photo text

    $(document).on('change','.uploadFile',function() {
        var i = $(this).prev('.custom-file-upload').clone();
        var file = $(this)[0].files[0].name;
        $(this).prev('.docPhoto').attr('placeholder',file);
    });

    // ADD IMAGE
    $('.image-uploader').change(function (event) {
        for (var one = 0; one < event.target.files.length; one++) {
            $(this).parents('.images-upload-block').find('.upload-area').append('<div class="uploaded-block" data-count-order="' + one + '"><video style="object-fit: fill;" controls src="' + URL.createObjectURL(event.target.files[one]) + '"></div>');
        }
    });

    // REMOVE IMAGE
    $('.images-upload-block').on('click', '.close',function (){
        $(this).parents('.uploaded-block').remove();
    });


    //scroll top
    var scrollButton = $("#scroll-top");
    $(window).scroll(function () {
        if ($(this).scrollTop() >= 700) {
            scrollButton.fadeIn(1000);
        } else {
            scrollButton.fadeOut(1000);
        }
    });

    //click to scroll top
    scrollButton.click(function () {
        $('html,body').animate({scrollTop: 0}, 600);
    });

});

setTimeout(function (){
    $('.layer-preloader').css('display','none')
    $("body").css("overflow-y", "auto")
},100);
//
//
//
// /* loading screen */
// $(window).on('load', function () {
//
//     $(".layer-preloader").fadeOut(700, function () {
//
//         $(".lds-dual-ring").delay(1000).fadeOut(700);
//
//         $("body").css("overflow-y", "auto");
//
//     });
//
// });




function goBack(){
    window.history.back();
}