<script>
    $(document).on('submit','.ajaxTaskSubmit',function(e) {
        e.preventDefault()
        var url = $(this).attr('action')
        $('.ajax-loader').css('display','flex');
        $.ajax({
            url: url,
            method     : 'post',
            data       : new FormData($(this)[0]),
            processData: false,
            contentType: false,
            success: function (response) {
                $('.ajax-loader').css('display','none');
            },
            error: function (xhr) {
                toastr           .error('{{__('web.taskFile')}}')
                $('.ajax-loader').css('display','none');
            },
        })
    })
</script>

<script type="text/javascript" src="{{setAsset('website/js/socket.js')}}"></script>

<script type="text/javascript">
    const socket = io("https://corsati.4hoste.com:4559" ,{transports: ['websocket', 'polling', 'flashsocket']});
</script>

<script type="text/javascript">


    document.getElementById('photo-upload').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        $('#chatImageMessage').css('display','block');
    }

    $(document).ready(function (){
        var objDiv            = document.getElementById("chatBox");
        objDiv.scrollTop      = objDiv.scrollHeight;
    });

    // Get the modal
    var modal                 = document.getElementById("myModal");
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var modalImg              = document.getElementById("img01");
    var captionText           = document.getElementById("caption");
    $('.myImg').on('click',function(){
        modal.style.display   = "block";
        modalImg.src          = this.src;
        captionText.innerHTML = this.alt;
    });

    // When the user clicks on <span> (x), close the modal
    $('.close').on('click',function() {
        $('#myModal').css('display','none') ;
    }) ;

    $(document).on('submit','.ajaxSendMessage',function(e) {
        e.preventDefault()
        var url              = $(this).attr('action')

        $.ajax({
            url            : url,
            method         : 'post',
            data           : new FormData($(this)[0]),
            processData    : false,
            contentType    : false,
            success        : function (response) {
                $('#message')  .val('');
                $('#chatBox')  .append(response);
                $('#photo-upload').val(null)
                $('#chatImageMessage').css('display','none');
                var objDiv = document.getElementById("chatBox");
                objDiv.scrollTop = objDiv.scrollHeight;
            },
            error: function (xhr) {
            },
        })
    });
</script>

<script src="https://www.youtube.com/player_api"></script>

<script type="text/javascript">
    // $(window).on('load', function() {

    var player;
    var videoId              = '{{$course->promotional_video_id}}';
    var time_update_interval = 0;
    function onYouTubePlayerAPIReady() {
        player               = new YT.Player('player', {
            height  : '390',
            width   : '640',
            host: 'https://www.youtube-nocookie.com',
            playerVars: {
                'autoplay' : 0,
                'controls' : 0,
                'modestbranding' :1,
                'autohide' : 1,
                'showinfo' : 0,
                'wmode'    : 'opaque',
                'rel'      : 0,
                'loop'     : 0,
                'disablekb': 1,
                'fs'       : 0, // Hide the full screen button

            },
            videoId : '{{$course->promotional_video_id}}',
            events  : {
                'onReady'      : onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });

    }

    // autoplay video
    function onPlayerReady(event) {
        // Clear any old interval.
        clearInterval(time_update_interval);
        // Start interval to update elapsed time display and
        // the elapsed part of the progress bar every second.
        time_update_interval = setInterval(function () {
            updateTimerDisplay();
            updateProgressBar();
        }, 1000)
        event.target.playVideo();

        $('iframe').css('pointer-events','none')
    }

    // This function is called by initialize()
    function updateTimerDisplay(){
        // Update current time text display.
        $('#current-time').text(formatTime( player.getCurrentTime() ));
        $('#duration')    .text(formatTime( player.getDuration() ));
    }

    function formatTime(time){
        time = Math.round(time);

        var minutes = Math.floor(time / 60),
            seconds = time - minutes * 60;

        seconds = seconds < 10 ? '0' + seconds : seconds;

        return minutes + ":" + seconds;
    }

    $('.progressRange').on('mouseup touchend', function (e) {
        // Calculate the new time for the video.
        // new time in seconds = total duration in seconds * ( value of range input / 100 )
        var newTime = player.getDuration() * (e.target.value / 100);

        // Skip video to new time.
        player.seekTo(newTime);
        //   $('#player-container').html('<i class="fas fa-pause"></i>');

    });
    $('.range-slider__range').on('mouseup touchend', function (e) {
        // Calculate the new time for the video.
        // new time in seconds = total duration in seconds * ( value of range input / 100 )
        var newTime = player.getDuration() * (e.target.value / 100);

        // Skip video to new time.
        player.seekTo(newTime);
        // $('#player-container').html('<i class="fas fa-pause"></i>');
    });

    $('#mute-toggle').on('click', function() {
        var mute_toggle = $(this);

        if(player.isMuted()){
            player.unMute();
            mute_toggle.html('<i class="fas fa-volume-up mute-toggle"></i>');
        }
        else{
            player.mute();
            mute_toggle.html('<i class="fas fa-volume-down mute-toggle"></i>');
        }
    });
    // This function is called by initialize()
    function updateProgressBar(){
        // Update the value of our progress bar accordingly.
        $('#progress'+videoId).val((player.getCurrentTime() / player.getDuration()) * 100);
        $('.range-slider__range').val((player.getCurrentTime() / player.getDuration()) * 100);
    }

    $(document).on('click','.fa-play', function () {

        player.playVideo();
        $('#player-container').html('<i class="fas fa-pause"></i>');
    });

    $(document).on('click','.fa-pause', function () {
        player.pauseVideo();
        $('#player-container').html('<i class="fas fa-play"></i>');
    });



    $('#volume-input').on('change', function () {
        player.setVolume($(this).val());
    });

    $('#speed').on('change', function () {
        player.setPlaybackRate(parseFloat($(this).val()));
    });

    iframe = $('#player');

    $('#quality').on('change', function () {
        player.setPlaybackQuality($(this).val());
    });

    //var fullscreen = document.getElementById('play-fullscreen');

    $('#play-fullscreen').on('click', function () {
        player.playVideo();
        var $$ = document.querySelector.bind(document);
        var iframe = $$('iframe');
        var req = iframe.requestFullscreen
            || iframe.webkitRequestFullscreen
            || iframe.mozRequestFullScreen
            || iframe.msRequestFullscreen;
        req.call(iframe);
    });

    // when video ends
    function onPlayerStateChange(event) {
        if(event.data === 0) {
            $.ajax({
                url         : '{{route('coursati.completeCourse')}}',
                method      : 'post',
                data        : {
                    'video_id' : videoId ,
                    '_token'   : '{{csrf_token()}}',
                    'completed': 1

                },
                success     : function (response) {
                    $('#status-'+videoId).html('{{__('web.Finished')}}');
                    $('#status-'+videoId).css('color','#F00');
                },
                error: function (xhr) {

                },
            })
        }
    }

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

    $(document).on('click','#favourite',function (){
        $.ajax({
            type                     : "POST",
            url                      : "{{route('coursati.favourite')}}",
            dataType                 : "json",
            data                     : {
                _token               : '{{csrf_token()}}',
                id                   : '{{$course->id}}',
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

    //   ================== IFrame ===================
    $(".click")      .click(function() {
        player       .loadVideoById( $(this).data('id'))
        videoId      = $(this).data('id');

        //  $('#progress'+videoId).val((player.getCurrentTime() / player.getDuration()) * 100);
        //  $('.range-slider__range').val((player.getCurrentTime() / player.getDuration()) * 100);
        $.ajax({
            url         : '{{route('coursati.completeCourse')}}',
            method      : 'post',
            data        : {
                'video_id' : videoId ,
                '_token'   : '{{csrf_token()}}',
                'completed': 0,
            },
            success     : function (response) {
                // $('.click')  .removeClass('fa-pause');
                // $('.click')  .addClass('fa-play');
                // $(this)      .removeClass('fa-play');
                // $(this)      .addClass('fa-pause');
                $('#status-'+videoId).html('Progress');
                $('#status-'+videoId).css('color','#3ae16d');
            },
            error: function (xhr) {

            },
        })
    });
    // });
</script>
<script>



    document.getElementById('photo-upload').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        $('#chatImageMessage').css('display','block');
    }


    $(document).on('submit','.ajaxCommentSubmit',function(e) {
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
                window .location.reload();
                toastr.success('{{__('web.Successfully_Add_Comment')}}')
            },
            error: function (xhr) {
                $('.error_messages')    .remove();
                $('#comment input')  .removeClass('border-danger')
                $.each(xhr.responseJSON .errors, function (key, value) {
                    $('#comment[name=' + key + ']')  .after('<small class="form-text error_messages text-danger">' + value + '</small>');
                });
            },
        })
    })
</script>

<script>
    $('#addStar').change('.star', function(e) {
        $(this).count('.count');
    });
</script>
