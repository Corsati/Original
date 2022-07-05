<script type="text/javascript">

    var topics      =  [];
    var levels      =  [];
    var prices      =  [];
    var durations   =  [];
    var ratings     =  [];
    var orderBy     =  'DESC';


    $(document).on('change','#orderBy',function (){
        orderBy     = $(this).val();
        callAjax();
    });

    $(document).on('click','.topic',function (){
        if(  topics.includes($(this).data('id')))
        {
            topics.splice(topics.indexOf($(this).data('id')), 1);
            $('#title-'+$(this).data('id')).remove()
        }else {
            topics.push($(this).data('id'))
            $('#titles').append(`<div id="title-${$(this).data('id')}" >${$(this).data('name')}<a class="deleteTitle"><i class="fas fa-times"></i></a></div>`)
        }
        callAjax();
    });

    $(document).on('click','.price',function (){
        if(  prices.includes($(this).data('id')))
        {
            prices.splice(prices.indexOf($(this).data('id')), 1);
        }else {
            prices.push($(this).data('id'))
        }
        callAjax();
    });

    $(document).on('click','.level',function (){
        if(  levels.includes($(this).data('id')))
        {
            levels.splice(levels.indexOf($(this).data('id')), 1);
        }else {
            levels.push($(this).data('id'))
        }
        callAjax();
    });

    $(document).on('click','.duration',function (){
        if(  durations.includes($(this).data('id')))
        {
            durations.splice(durations.indexOf($(this).data('id')), 1);
        }else {
            durations.push($(this).data('id'))
        }
        callAjax();
    });
    $(document).on('click','.rate',function (){
        if(  ratings.includes($(this).data('id')))
        {
            ratings.splice(ratings.indexOf($(this).data('id')), 1);
        }else {
            ratings.push($(this).data('id'))
        }
        callAjax();
    });


    //do ajax
    function callAjax(){
        $.ajax({
            type                     : "POST",
            url                      : "{{route('coursati.search')}}",

            data : {
                _token  : '{{csrf_token()}}',
                topics,
                levels  ,
                prices  ,
                durations ,
                ratings  ,
                orderBy,
                ajax : true
            },

            success: function (data) {
                if(data !== '')
                {
                    $('#courses').html(data)
                }else{
                    $('#courses').html('')
                }
            },
            error: function (request, status, error) {
                alert(error);
            }
        });
    }

</script>