<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

@if(!auth()->guest())
    <script src="https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.4/firebase.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script type="text/javascript">
        var path = "{{ route('coursati.autocomplete') }}";
        $('input.typeahead').typeahead({
            source:  function (query, process) {
                return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
            }
        });
    </script>
    <script>
        var firebaseConfig   = {
            apiKey           : "AIzaSyBfmuetfJYTKqbv_vVgZvDAhrrowkeb79k",
            authDomain       : "corsati.firebaseapp.com",
            projectId        : "corsati",
            storageBucket    : "corsati.appspot.com",
            messagingSenderId: "259659203858",
            appId            : "1:259659203858:web:db4d687c8ff41632119fcb",
            measurementId    : "G-Q6KVBDP6FH"
        };

        firebase.initializeApp(firebaseConfig);
        const messaging      = firebase.messaging();


        initFirebaseMessagingRegistration();
        function initFirebaseMessagingRegistration() {
            messaging
                .requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function(token) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url     : '{{ route("coursati.save-token") }}',
                        type    : 'POST',
                        data    : {
                            token : token
                        },
                        dataType: 'JSON',
                        success : function (response) {

                        },
                        error: function (err) {
                        },
                    });

                }).catch(function (err) {});
        }


        messaging.onMessage(function(payload) {
            const    noteTitle   = payload.notification.title;
            const    noteOptions = {
                body: payload.notification.body,
                icon: 'https://corsati.online/public/website/img/logoo.svg',
            };

            $(window).blur(function(){
                new Notification(noteTitle, noteOptions);
            })

            if (!document.hidden) {
                toastr.warning(payload.notification.body);
            }
        });
    </script>
@endif
<script type="text/javascript">
    $(document).on('click','.section-data',function (){
        $.ajax({
            type            : "POST",
            url             : "{{route('coursati.category-courses')}}",
            data            : {
                id          : $(this).data('id'),
                _token      : '{{csrf_token()}}'
            },
            dataType        : "json",
            success: function (data) {
                $('#courses-tab').html(data)
            }
        });
    });

    @if($categories->first())
    $(window).on('load',function(){
        $.ajax({
            type                             : "POST",
            url                              : "{{route('coursati.category-courses')}}",
            data                             : {
                id                           : '{{$categories->first()->id}}',
                _token                       : '{{csrf_token()}}',
                take                         : 4,
            },
            dataType                         : "json",
            success: function (data) {

                $('#courses-tab').html(data)
                $.ajax({
                    type                     : "GET",
                    url                      : "{{route('coursati.popularCategories')}}",
                    dataType                 : "json",
                    success: function (data) {
                        $('#popular-categories')  .html(data)
                    }
                });
            }
        });
    })
    @endif
    $(document).on('click','.section-data',function (){
        $.ajax({
            type            : "POST",
            url             : "{{route('coursati.category-courses')}}",
            data            : {
                id          : $(this).data('id'),
                take        : 4,
                _token      : '{{csrf_token()}}'
            },
            dataType        : "json",
            success: function (data) {
                $('#courses-tab').html(data)
            }
        });
    });

    $(window).on('load',function(){
        @if(auth()->guest())
        //$('.sliderBg').css('background','url(/website/img/bg.webp) no-repeat center center')
        @endif
        @if(count($categories)>0)
        $.ajax({
            type                             : "POST",
            url                              : "{{route('coursati.category-courses')}}",
            data                             : {
                id                           : '{{$categories->first()->id}}',
                _token                       : '{{csrf_token()}}',
                take                         : 4,
            },
            dataType                         : "json",
            success: function (data) {
                $('#courses-tab').html(data)
            }
        });
        @endif
    })

    $(document).on('submit','.ajaxContactSubmit',function(e) {
        e.preventDefault()
        $.ajax({
            url                        : $(this).attr('action'),
            method                     : 'post',
            data                       : new FormData($(this)[0]),
            processData                : false,
            contentType                : false,
            success                    : function (response) {
                toastr                 .success('{{__('web.created_successfully')}}')
                location.href          = response.url;
            },
            error: function (xhr) {
                $('.error_messages')   .remove();

                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $('input[name='+key+'] ,select[name='+key+'],textarea[name='+key+']').removeClass('border-danger').after('<small class="form-text error_messages text-danger">' + value + '</small>').focus()
                    });
                    toastr.error(xhr.responseJSON.errors[Object.keys(xhr.responseJSON.errors)[Object.keys(xhr.responseJSON.errors).length - 1]][0])
            },
        })
    })

    $(document).on('submit','.ajaxSubmit',function(e) {
        e.preventDefault()
        var url = $(this).attr('action')
        jQuery('.alert-danger').hide()
        $.ajax({
            url         : url,
            method      : 'post',
            data        : new FormData($(this)[0]),
            processData : false,
            contentType : false,
            success     : function (response) {
                location.href= response.url;
                toastr  .success('Send Successfully')
            },
            error: function (xhr) {
                $('.error_messages')         .remove();
                $.each(xhr.responseJSON.errors, function (key, value) {
                    $('#ajaxSubmit input[name='+key+'] ,select[name='+key+'],textarea[name='+key+']').removeClass('border-danger').after('<small class="form-text error_messages text-danger">' + value + '</small>').focus()
                });
                // toastr.error(xhr.responseJSON.errors[Object.keys(xhr.responseJSON.errors)[Object.keys(xhr.responseJSON.errors).length - 1]][0])
            },
        })
    })

    $(document).on('submit','.ajaxUpgradeSubmit',function(e) {
        e.preventDefault()
        var url             = $(this).attr('action')
        jQuery('.alert-danger').hide()
        $.ajax({
            url                             : url,
            method                          : 'post',
            data                            : new FormData($(this)[0]),
            processData                     : false,
            contentType                     : false,
            success                         : function (response) {
                location.href= response.url;
                toastr  .success('{{__('web.created_successfully')}}')
            },
            error: function (xhr) {
                $('.error_messages')         .remove();
                $.each(xhr.responseJSON.errors, function (key, value) {
                    $('input[name='+key+'] ,select[name='+key+'],textarea[name='+key+']').removeClass('border-danger').after('<small class="form-text error_messages text-danger">' + value + '</small>').focus()
                });
                toastr.error(xhr.responseJSON.errors[Object.keys(xhr.responseJSON.errors)[Object.keys(xhr.responseJSON.errors).length - 1]][0])
            },
        })
    })

    $(document).on('submit','.ajaxProfileSubmit',function(e) {
        e.preventDefault()
        var url = $(this).attr('action')
        jQuery('.alert-danger').hide()
        $.ajax({
            url: url,
            method: 'post',
            data: new FormData($(this)[0]),
            processData: false,
            contentType: false,
            success: function (response) {
                window.location.reload()
                toastr.success('{{__('web.updated_successfully')}}')
            },
            error: function (xhr) {
                $('.error_messages')        .remove();
                $.each(xhr.responseJSON.errors, function (key, value) {
                    $('input[name='+key+'] ,select[name='+key+'],textarea[name='+key+']').removeClass('border-danger').after('<small class="form-text error_messages text-danger">' + value + '</small>').focus()
                });
                toastr.error(xhr.responseJSON.errors[Object.keys(xhr.responseJSON.errors)[Object.keys(xhr.responseJSON.errors).length - 1]][0])
            },
        })
    })
    $(document).on('submit','.EditPasswordSubmit',function(e) {
        e.preventDefault()
        var url = $(this).attr('action')
        jQuery('.alert-danger').hide()
        $.ajax({
            url: url,
            method: 'post',
            data: new FormData($(this)[0]),
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.status == false){
                    toastr.error(response.msg) 
                }else{
                    window.location.reload()
                    toastr.success('{{__('web.updated_successfully')}}')
                }
               
            },
            error: function (xhr) {
                $('.error_messages')        .remove();
                $.each(xhr.responseJSON.errors, function (key, value) {
                    $('input[name='+key+'] ,select[name='+key+'],textarea[name='+key+']').removeClass('border-danger').after('<small class="form-text error_messages text-danger">' + value + '</small>').focus()
                });
                toastr.error(xhr.responseJSON.errors[Object.keys(xhr.responseJSON.errors)[Object.keys(xhr.responseJSON.errors).length - 1]][0])
            },
        })
    })
    $(".deleteCategory").click(function(){
        var id    = $(this).data("id");
        var token = $(this).data("token");
        $.ajax(
            {
                url          : "delete/"+id,
                type         : 'DELETE',
                dataType     : "JSON",
                data: {
                    "id"     : id,
                    "_method": 'DELETE',
                    "_token" : token,
                },
                success: function ()
                {
                    window.location.reload();
                }
            });
    });

    // $(document).on('submit','.ajaxSubmit',function(e) {
    //     e.preventDefault()
    //     $('.ajax-loader').css('display','flex');
    //     var url = $(this).attr('action')
    //     jQuery('.alert-danger').hide()
    //     $.ajax({
    //         url         : url,
    //         method      : 'post',
    //         data: new FormData($(this)[0]),
    //         processData : false,
    //         contentType : false,
    //         success     : function (response) {
    //             $('.ajax-loader').css('display','none');
    //             location.href= response.url;
    //             toastr  .success('Successfully Registered')
    //         },
    //         error: function (xhr) {
    //             $('.ajax-loader').css('display','none');
    //             $('.error_messages')    .remove();
    //             $.each(xhr.responseJSON.errors, function (key, value) {
    //                 $('input[name='+key+'] ,select[name='+key+'],textarea[name='+key+']').removeClass('border-danger').after('<small class="form-text error_messages text-danger">' + value + '</small>').focus()
    //             });
    //             toastr.error(xhr.responseJSON.errors[Object.keys(xhr.responseJSON.errors)[Object.keys(xhr.responseJSON.errors).length - 1]][0])
    //         },
    //     })
    // })

    $(document).on('submit','.ajaxLoginSubmit',function(e) {
        e.preventDefault()
        var url            = $(this).attr('action')
        jQuery('.alert-danger').hide()
        $.ajax({
            url            : url,
            method         : 'post',
            data           : new FormData($(this)[0]),
            processData    : false,
            contentType    : false,
            success        : function (response) {
                if(response.status === true)
                {
                    window .location.reload();
                    toastr .success('{{__('web.loginSuccess')}}')
                }else {
                    toastr .error(response.msg)
                }

            },
            error: function (xhr) {
                $('.error_messages')          .remove();
                $.each(xhr.responseJSON.errors, function (key, value) {
                    $('#ajaxLoginSubmit input[name='+key+'] ,select[name='+key+'],textarea[name='+key+']').removeClass('border-danger').after('<small class="form-text error_messages text-danger">' + value + '</small>').focus()
                });
                toastr.error(xhr.responseJSON.errors[Object.keys(xhr.responseJSON.errors)[Object.keys(xhr.responseJSON.errors).length - 1]][0])
            },
        })
    })



    function showAlert(){
        swal('{{__('web.soon')}}');
    }

    $('img').loadScroll(500);// in ms
    $('select#country,select#country_id').on('change', function (e) {
        var $CITY           = $('#city');
        var $CITYS          = $('#citiesId');
        $CITY               .empty();
        $CITYS              .empty();
        var countryId       = $(this).val();
        $.ajax({
            type            : "POST",
            url             : "{{route('coursati.countries.cities')}}",
            dataType        : "json",
            data: {
                'country_id': countryId,
                '_token'    : '{{csrf_token()}}'
            },
            success         : function (data) {
                $CITY       .html(data);
                $CITYS      .html(data);
                $CITY       .selectpicker('refresh');
                $CITYS      .selectpicker('refresh');
            }
        });
    });

    $('.imageUploader').change(function (event){
        $(this).parents('.imagesUploadBlock')
            .append('<div class="changeImg"><img src="'+ URL.createObjectURL(event.target.files[0]) +'"><button class="close"><i class="fas fa-times"></i></button></div>');
    });
    // REMOVE IMAGE
    $('.dropBox').on('click', '.close',function (){
        $(this).parent().remove();
    });

    function getTimeRemaining(endtime) {
        var t           = Date.parse(endtime) - Date.parse(new Date());
        var seconds     = Math.floor((t / 1000) % 60);
        var minutes     = Math.floor((t / 1000 / 60) % 60);
        var hours       = Math.floor((t / (1000 * 60 * 60)) % 24);
        var days        = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
            'total'     : t,
            'days'      : days,
            'hours'     : hours,
            'minutes'   : minutes,
            'seconds'   : seconds
        };
    }

    $('.imageUploader')  .change(function (event){
        $(this).parents('.imagesUploadBlock').append('<div class="changeImg"><img src="'+ URL.createObjectURL(event.target.files[0]) +'"><button class="close"><i class="fas fa-times"></i></button></div>');
    });

    // REMOVE IMAGE
    $('.dropBox').on('click', '.close',function (){
        $(this)  .parent().remove();
    });

    $(document).on('keyup','input',function (){
        $(this).parent().find('small').remove()
    })

    $(document).on('keyup','textarea',function (){
        $(this).parent().find('small').remove()
    })

    $(document).on('change','select',function (){
        $(this).closest('small').remove()
    })
    function matchYoutubeUrl(url) {
        var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
        var matches = url.match(p);
        if(matches){
            return matches[1];
        }
        return false;
    }
    function check(input){
        if(input.val() != ''){
            var id = matchYoutubeUrl(input.val());
            if(id!=false){
                return true

            }else{
                input.val('');
                swal('{{__('web.Incorrect URL')}}');
                return false
            }
        }
        return  true;
    }

    $(function () {
        $(document).on('submit', '.ajaxRegisterSubmit', function (e) {
            e.preventDefault()
            $('.ajax-loader').css('display', 'flex');
            $.ajax({
                url        : $(this).attr('action'),
                method     : 'post',
                data       : new FormData($(this)[0]),
                processData: false,
                contentType: false,
                success    : function (response) {
                    $('.ajax-loader').css('display', 'none');
                    location.href = response.url;
                    toastr              .success('{{__('web.created_successfully')}}')
                },
                error: function (xhr) {
                    $('.ajax-loader')   .css('display', 'none');
                    $('.error_messages').remove();
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        if(key == 'category_id'){
                        $('#fields').removeClass('border-danger').after('<small class="form-text error_messages text-danger">' + value + '</small>').focus()   
                        }
                        $('input[name='+key+'] ,select[name='+key+'],textarea[name='+key+']').removeClass('border-danger').after('<small class="form-text error_messages text-danger">' + value + '</small>').focus()
                    });
                    toastr.error(xhr.responseJSON.errors[Object.keys(xhr.responseJSON.errors)[Object.keys(xhr.responseJSON.errors).length - 1]][0])
                },
            })
        })

        $('#photo-upload').tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
        $('#photo-upload').on('click', function () {
            $(this).tooltip('destroy');
        });
        $('select#country,select#country_id').on('change', function (e) {
            var $CITY           = $('#cityId');
            var $cityID         = $('#cityID');
            $CITY               .empty();
            $cityID             .empty();
            var countryId       = $(this).val();
            $.ajax({
                type            : "POST",
                url             : "{{route('coursati.countries.cities')}}",
                dataType        : "json",
                data: {
                    'country_id': countryId,
                    '_token'    : '{{csrf_token()}}'
                },
                success         : function (data) {
                    $CITY       .html(data);
                    $cityID     .html(data);
                    $CITY       .selectpicker('refresh');
                    $cityID     .selectpicker('refresh');
                }
            });
        });
    });
    $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
        $(e.target).prev().find("i:last-child").toggleClass("fa-minus fa-plus");
        $(e.target).prev().toggleClass("whiteBg");
        $(e.target).prev().find('.headTitle span').toggleClass("bgLightGray");
    });

    $(".expandAll").click(function () {
        $("#accordion").find("i:last-child").removeClass("fa-plus").addClass('fa-minus');
        $("#accordion").find('.card-header').removeClass("whiteBg");
        $("#accordion").find('.headTitle span').removeClass("bgLightGray");
        $("#accordion").find('.collapse').addClass("show");
    });
</script>
@if((request()->is('/') || request()->is('index')) && $offer)
    @if(auth()->guest())
    <script type="text/javascript">
        var deadline = new Date(Date.parse('{{str_replace('-','/',$offer->expire_date)}}') + 15 * 24 * 60 * 60 * 1000);
        setTimeout(function (){
            initializeClock('clockdiv', deadline);
        },2000)

        function initializeClock(id, endtime) {
            var clock       = document.getElementById(id);
            var daysSpan    = clock.querySelector('.days');
            var hoursSpan   = clock.querySelector('.hours');
            var minutesSpan = clock.querySelector('.minutes');
            var secondsSpan = clock.querySelector('.seconds');

            function updateClock() {
                var t        = getTimeRemaining(endtime);
                daysSpan   .innerHTML    = t.days;
                hoursSpan  .innerHTML    = ('0' + t.hours).slice(-2);
                minutesSpan.innerHTML    = ('0' + t.minutes).slice(-2);
                secondsSpan.innerHTML    = ('0' + t.seconds).slice(-2);

                if (t.total <= 0) {
                    clearInterval(timeinterval);
                }
            }
            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }
    </script>
    @endif
@endif