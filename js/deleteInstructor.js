$(document).ready(function() {
  $('.button-delete').click(function() {
    $.ajax({
      type: "GET",
      contentType: "application/json",
      url: '../../web_services/instructors/deleteInstructorService.php',
      data: {
        "id_instructor": $(this).prop('id')
      },
      success: function (result) {
        $.ajax({
          async: true,
          url: '../views/deleteInstructor.php'
        }).done(function(data) { // data what is sent back by the php page
          $('#notifications-text').html("Registro eliminado correctamente");
          $('#notifications').removeClass('alert-danger');
          $('#notifications').addClass('alert-success');
          $('#notifications').css("display","block");
          $('.modal-backdrop').remove();
        });
      },
      error: function(result){
        $('#notifications-text').html("No es posible eliminar el ponente porque tiene al menos una conferencia asignada.");
        $('#notifications').removeClass('alert-success');
        $('#notifications').addClass('alert-danger');
        $('#notifications').css("display","block");
        $('.modal-backdrop').remove();
      }
    });
  });
});