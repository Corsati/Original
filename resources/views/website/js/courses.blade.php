<script type="text/javascript">
    $(document).on('click','.deleteCourse',function (e){
        e.preventDefault();
        swal({
            title: "{{__('web.Are you sure?')}}",
            text: "{{__('web.Once deleted, you will not be able to recover this imaginary file!')}}",
            icon: "warning",
            buttons: {
                cancel: "{{__('web.cancel')}}",
                catch: {
                    text: "{{__('web.delete')}}",
                    value: "catch",
                },
            },            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal("{{__('web.Poof! Your imaginary file has been deleted!')}}", {
                        icon: "success",
                    });
                    window.location.href = $(this).attr('href')
                } else {
                    swal('{{__('web.Your imaginary file is safe!')}}');
                }
            });
    });
</script>
