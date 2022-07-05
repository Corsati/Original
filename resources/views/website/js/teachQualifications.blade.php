<script type="text/javascript">

    let x = 1;
    $(document).on('click', '#more_Teaching_Categories', function () {
        var $body = $('.more_Teaching_Categories');
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "{{url('website-instructor-teachings')}}" + '/' + x, false);
        ajax.send();
        $body.append(ajax.responseText);
        x++;
        $(".selectpicker").selectpicker('refresh');
    });

    $(document).on('click', '.deleteBtn', function () {
        $(this).parent().closest('.row-categories').remove();
    });

    let y = 1;
    $(document).on('click', '#more_academics', function () {
        var $body = $('.more_academics');
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "{{url('website-instructor-academics')}}" + '/' + y, false);
        ajax.send();
        $body.append(ajax.responseText);
        x++;
        $(".selectpicker").selectpicker('refresh');
    });

    $(document).on('click', '.deleteBtn', function () {
        $(this).parent().closest('.row-academics').remove();
    });

    $(document).on('submit', '.ajaxCompleteTeacherSubmit', function (e) {
        e.preventDefault()
        $('.ajax-loader').css('display', 'flex');
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
                $('.ajax-loader').css('display', 'none');
            },
            error: function (xhr) {
                $('.ajax-loader').css('display', 'none');
            },
        })
    })
    // $('#proof').tooltip({placement: 'bottom', trigger: 'manual'}).tooltip('show');
    // $('#proof').on('click', function () {
    //     $(this).tooltip('destroy');
    // });

    // window.onbeforeunload = function() { return "Your work will be lost."; };

</script>