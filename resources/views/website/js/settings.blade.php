<script type="text/javascript">
    $('#close-account').on('click',function (){
        swal({
            title: "{{__('web.Are you sure?')}}",
            text: "{{__('web.once closed')}}",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type            : "POST",
                        url             : "{{route('coursati.closeAccount')}}",
                        dataType        : "json",
                        data: {
                            '_token'    : '{{csrf_token()}}'
                        },
                        success: function (data) {
                            window.location.href = '{{route('coursati.logout')}}'
                        }
                    });
                } else {

                }
            });
    });
</script>
