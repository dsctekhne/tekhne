$(document).ready(function() {
  $('.button-delete').click(function() {
    $.ajax({
      type: "GET",
      contentType: "application/json",
      url: '../../web_services/conferences/deleteConferenceService.php',
      data: {
        "id_conference": $(this).prop('id')
      },
      success: function (result) {
        $.ajax({
          async: true,
          url: '../views/deleteConference.php'
        }).done(function(data) { // data what is sent back by the php page
          $('.content-wrapper').html(data);
          $('#notifications-text').html("Registro eliminado correctamente");
          $('#notifications').css("display","block");
          $('.modal-backdrop').remove();
        });
      },
      error: function(result){
      }
    });
  });
});