$(function () {
  $("#example1").DataTable();
  // $('#example2').DataTable({
  //   "paging": true,
  //   "lengthChange": false,
  //   "searching": false,
  //   "ordering": true,
  //   "info": true,
  //   "autoWidth": false,
  // });



  //img uploader
  $( document ).on( 'change', '.image-uploader', function (event) {
    // $('.image-uploader').change(function (event) {
    for (var one = 0; one < event.target.files.length; one++) {
      // alert(1);
      $(this).parents('.images-upload-block').find('.upload-area').append('<div class="uploaded-block" data-count-order="' + one + '"><img src="' + URL.createObjectURL(event.target.files[one]) + '"><button class="close">&times;</button></div>');
    }
  });

  $('.images-upload-block').on('click', '.close',function (){
    $(this).parents('.uploaded-block').remove();
  });

});
