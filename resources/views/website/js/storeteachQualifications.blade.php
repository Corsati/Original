<script type="text/javascript">
    $(document).on('submit', '.ajaxSubmit', function (e) {
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
                location.href = response.url;
            },
            error: function (xhr) {
                $('.error_messages').remove();
                $.each(xhr.responseJSON.errors, function (key, value) {
                    $('input[name=' + key + '] ,select[name=' + key + '],textarea[name=' + key + ']').removeClass('border-danger').after('<small class="form-text error_messages text-danger">' + value + '</small>').focus()
                });
                toastr.error(xhr.responseJSON.errors[Object.keys(xhr.responseJSON.errors)[Object.keys(xhr.responseJSON.errors).length - 1]][0])
            },
        })
    })
    $('.imageUploader').change(function (event) {
        $(this).parents('.imagesUploadBlock').append('<div class="changeImg"><img src="' + URL.createObjectURL(event.target.files[0]) + '"><button class="close"><i class="fas fa-times"></i></button></div>');
    });
    // REMOVE IMAGE
    $('.dropBox').on('click', '.close', function () {
        $(this).parent().remove();
    });

    let x = 2;
    $(document).on('click', '#more_Teaching_Categories', function () {
        var $body = $('.more_Teaching_Categories');
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "{{url('website-instructor-teachings')}}" + '/' + x, false);
        ajax.send();
        $body.append(ajax.responseText);
        x++;
    });

    $(document).on('click', '.deleteBtn', function () {
        $(this).parent().closest('.row').remove();
    });
</script>