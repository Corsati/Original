<script type="text/javascript">
    $('#draft').on('click', function () {
        $('#type').val('later');
    });

    {{--var results = '{!! $courseCategories !!}';--}}
    {{--console.log(results)--}}
    {{--$('.selectpicker').selectpicker('val','{!! $courseCategories !!}');--}}


    var uploadField = document.getElementById("promotional_video");

    uploadField.onchange = function() {
        if(this.files[0].size > 2097152){
            alert("File is too big!");
            this.value = "";
        };
    };
    $(document).on("change", '.file-uploads', function (event) {
        let file = event.target.files[0];
        let blobURL = URL.createObjectURL(file);
        document.querySelector("video").src = blobURL;
    })

    $(document).on('click', '#add-requirements', function (e) {
        e.preventDefault();
        var $body = $('#more-requirements');
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "{{route('coursati.courseRequirement')}}", false);
        ajax.send();
        $body.append(ajax.responseText);
        $(this).remove();
    });

    $(document).on('submit', '.ajaxCourseSubmit', function (e) {
        e.preventDefault()
        $('.ajax-loader').css('display','flex');
        if(check( $('#promotional_video')))  {
            var url = $(this).attr('action')
            jQuery('.alert-danger').hide()
            $.ajax({
                url: url,
                method: 'post',
                data: new FormData($(this)[0]),
                processData: false,
                contentType: false,
                success: function (response) {

                    location.href = response.url;
                    toastr.success('{{__('web.created_successfully')}}')
                    $('.ajax-loader').css('display','none');
                },
                error: function (xhr) {
                    $('.ajax-loader').css('display','none');
                    $('.error_messages').remove();
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $('input[name='+key+'] ,select[name='+key+'],textarea[name='+key+']').removeClass('border-danger').after('<small class="form-text error_messages text-danger">' + value + '</small>').focus()
                    });
                    toastr.error(xhr.responseJSON.errors[Object.keys(xhr.responseJSON.errors)[Object.keys(xhr.responseJSON.errors).length - 1]][0])
                },
            })
        }


    })
    $(document).on("change", "#promotional_video", function(evt) {
        var $source = $('#video_here');
        $source[0].src = URL.createObjectURL(this.files[0]);
        $source.parent()[0].load();
    });
    $('#photo-upload').tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
    $('#photo-upload').on('click', function () {
        $(this).tooltip('destroy');
    });

    $('#photoUpload').tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
    $('#photoUpload').on('click', function () {
        $(this).tooltip('destroy');
    });
</script>
