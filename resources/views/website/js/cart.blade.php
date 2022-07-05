<script type="text/javascript">
    $(document).on('click','#deleteItem',function (){
        $.ajax({
            type                     : "POST",
            url                      : "{{route('coursati.deleteItem')}}",
            dataType                 : "json",
            data                     : {
                _token               : '{{csrf_token()}}',
                id                   : $(this).data('id')
            },
            success: function (data) {
                if(data.count        === 0)
                {
                    window.location.href = "{{route('coursati.index')}}"
                }
                toastr.success(data.msg)
                $('.total')          .text(data.total + ' $ ');
                $(this)              .parent().closest('.cartItem').remove();
            }
        });
    });
</script>