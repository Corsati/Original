<script type="text/javascript">



    $(document).ready(function (){
        var objDiv = document.getElementById("chatBox");
        objDiv.scrollTop = objDiv.scrollHeight;
    });



    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption

    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    $('.myImg').on('click',function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    });

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    $('#close').on('click',function() {
        $('#myModal').css('display','none') ;
    }) ;


    document.getElementById('photo-upload').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        $('#chatImageMessage').css('display','block');
    }


    $(document).on('submit','.ajaxSendMessage',function(e) {
        e.preventDefault()
        var url            = $(this).attr('action')

        $.ajax({
            url            : url,
            method         : 'post',
            data           : new FormData($(this)[0]),
            processData    : false,
            contentType    : false,
            success        : function (response) {
                $('#message')  .val('');
                $('#chatBox')  .append(response);
                $('#photo-upload').val(null)
                $('#chatImageMessage').css('display','none');
                var objDiv = document.getElementById("chatBox");
                objDiv.scrollTop = objDiv.scrollHeight;
            },
            error: function (xhr) {
            },
        })
    });

    function refreshChat(room){

        if('{{auth()->id()}}' == room.sender.id)
        {
            $('#headName')   .html(room.receiver.first_name);
            $('#headImage')  .attr('src',room.receiver.avatar);
        }else {
            $('#headName')   .html(room.sender.first_name);
            $('#headImage')  .attr('src',room.sender.avatar);
        }
        $('#room')           .val(room.id)
        $('#courseId')       .val(room.course_id)
        $.ajax({
            url              : '{{route('coursati.inbox')}}',
            method           : 'POST',
            data             : {
                'room'       : room,
                '_token'     :'{{csrf_token()}}',
            },
            success          : function (response) {
                $('#chatBox')  .html(response);
            },
            error: function (xhr) {

            },
        })
    }
</script>
