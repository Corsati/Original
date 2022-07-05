<script type="text/javascript">
    $(document).on('change','#rating',function (){
        $.ajax({
            type                     : "POST",
            url                      : "{{route('coursati.filterByRate')}}",
            dataType                 : "json",
            data                     : {
                id                   : '{{$category->id}}',
                rate                 : $(this).val(),
                _token               : '{{csrf_token()}}'
            },
            success: function (data) {
                $('#course-container').html(data)
            }
        });
    });
</script>