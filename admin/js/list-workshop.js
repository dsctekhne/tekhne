$(document).ready(function() {
  $('.button-event').click(function() {
    var control_number =  $(this).prop('id').split('-')[0].toString();
    var id_workshop =  $(this).prop('id').split('-')[1].toString();
    $.ajax({
      type: "GET",
      contentType: "application/json",
      url: '../../web_services/assistants/registerPayWorkshopService.php',
      data: {
        "control_number" : control_number,
        "id_workshop" : id_workshop
      },
      success: function (result) {
        $.ajax({
          async: true,
          url: '../views/listWorkshops.php'
        }).done(function(data) { // data what is sent back by the php page
          $('.content-wrapper').html(data);
          $('#notifications-text').html("Pago registrado correctamente");
          $('#notifications').css("display","block");
          $('.modal-backdrop').remove();
        });
      },
      error: function(){
      }
    });
  });
});