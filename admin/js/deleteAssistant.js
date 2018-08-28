$(document).ready(function() {
  $('.button-delete').click(function() {
    
    $.ajax({
      type: "GET",
      contentType: "application/json",
      url: '../../web_services/assistants/deleteAssistantService.php',
      data: {
        "control_number": $(this).prop('id')
      },
      success: function (result) {
        $.ajax({
          async: true,
          url: '../views/deleteAssistant.php'
        }).done(function(data) { // data what is sent back by the php page
          $('.content-wrapper').html(data);
          $('#notifications-text').html("Registro eliminado correctamente");
          $('#notifications').css("transition","3s");
          $('#notifications').css("display","block");
          $('.modal-backdrop').remove();
        });
      },
      error: function(result){
      }
    });
  });
});