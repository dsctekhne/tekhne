$(document).ready(function() {
  $('.button-delete').click(function() {
    $.ajax({
      type: "GET",
      contentType: "application/json",
      url: '../../web_services/speakers/deleteSpeakerService.php',
      data: {
        "id_speaker": $(this).prop('id')
      },
      success: function (result) {
        $.ajax({
          async: true,
          url: '../views/deleteSpeaker.php'
        }).done(function(data) { // data what is sent back by the php page
          $('.content-wrapper').html(data);
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