<script type="text/javascript">
    $('#draft')     .on('click',function ()
    {
        $('#steps') .val('two') ;
    });
    var x = 1;
    $(document).on('click', '#addBenefits', function () {
        var $body = $('#more-benefits');
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "{{route('coursati.benefits')}}", false);
        ajax.send();
        $body.append(ajax.responseText);
    });

    $(document).on('click', '#addContents', function () {
        var $body = $('#more-contents');
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "{{route('coursati.contents')}}", false);
        ajax.send();
        $body.append(ajax.responseText);
    });

    $(document).on('click', '#addCertificates', function () {
        var $body = $('#more-certificates');
        var ajax = new XMLHttpRequest();
        ajax.open("GET", "{{url('coursati-certificates')}}" + '/' + x, false);
        ajax.send();
        $body.append(ajax.responseText);
    });


    $(document).on('submit', '.ajaxSubmits', function (e) {
        e.preventDefault()
        $('.ajax-loader').css('display','flex');
        var url = $(this).attr('action')
        jQuery('.alert-danger').hide()
        $.ajax({
            url: url,
            method: 'post',
            data: new FormData($(this)[0]),
            processData: false,
            contentType: false,
            success: function (response) {
                $('.ajax-loader').css('display','none');
                location.href = response.url;
                toastr.success('{{__('web.created_successfully')}}')
            },
            error: function (xhr) {
                $('.ajax-loader').css('display','none');
            },
        })
    })

    $(document).on('click','.minus',function (e){
        e.preventDefault();
        $(this).parent().remove();
    });
</script>
