<script type="text/javascript">


    var x             = 1;
    var y             = 0;
    $(document).on('click','#addMoreLec',function (){
        y++
        var $body     = $('#lectures');
        var ajax      = new XMLHttpRequest();
        ajax          .open("GET"   , "{{url('course-lectures')}}"+ '/'+ x + '/'+ y , false);
        ajax          .send();
        $body         .append(ajax.responseText);
        x++;
    });

    $(document).on('click','.add',function (e){
        e.preventDefault();
        let v          = $(this).data('id')
        var ajax       = new XMLHttpRequest();
        ajax           .open("GET"   , "{{url('course-lectures-content')}}"+ '/'+ x + '/'+ v , false);
        ajax           .send();
        $(this)        .closest('.rowSpace')  .append(ajax.responseText);
        x++;
    });

    $(document)        .on('click','.minus',function (){
        $(this)        .closest('.lectureContainer').remove();
    });

    $('#draft')        .on('click',function ()
    {
        $('#type')     .val('later') ;
    });

    $(document).on('submit','.ajaxStepTwoSubmit',function(e) {
        e.preventDefault()

        $('.ajax-loader').css('display','flex');
        var url             = $(this).attr('action')
        jQuery('.alert-danger').hide()
        $.ajax({
            url         : url,
            method      : 'post',
            data        : new FormData($(this)[0]),
            processData : false,
            contentType : false,
            success     : function (response) {
                location.href= response.url;
                $('.ajax-loader').css('display','none');
                toastr  .success('{{__('web.created_successfully')}}')
            },
            error       : function (xhr) {
                $('.ajax-loader').css('display','none');
            },
        })
    })


    $(document).on('click','.minusContent',function (e){
        e.preventDefault()

        $('.lectureContent-'+$(this).data('id')).remove()
    });
</script>
