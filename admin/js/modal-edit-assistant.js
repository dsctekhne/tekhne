$(document).ready(function() {
  var control_number_old;
  $('.button-edit').click(function() {
    control_number_old = $(this).prop('id');
    showEditModal($(this).prop('id'));
    
  });
  $('form').submit(function(e) {
    $.ajax({
      type: "GET",
      contentType: "application/json",
      url: '../../web_services/assistants/editAssistantService.php',
      data: {
        "control_number_old" : control_number_old,
        "control_number" : $('#input-control-number').val(),
        "name" : $('#input-name').val().toString(),
        "paternal_surname" : $('#input-paternal_surname').val().toString(),
        "maternal_surname" : $('#input-maternal_surname').val().toString(),
        "email" : $('#input-email').val().toString(),
        'id_career' : $('#input-id_career option:selected').val().toString(),
      },
      success: function (result) {
        $('#modal-edit-assistant').modal('toggle');
        $.ajax({
          async: true,
          url: '../views/editAssistant.php'
        }).done(function(data) { // data what is sent back by the php page
          $('.content-wrapper').html(data);
          $('#notifications-text').html("Registro actualizado correctamente");
          $('#notifications').css("display","block");
          $('.modal-backdrop').hide();
          $('.fade').hide();
          $('.in').hide();
        });
      },
      error: function(result){
        $('#notifications').html("Ha ocurrido un error.");
      }
    });
    e.preventDefault();
  });
});

function showEditModal($control) {
  $.ajax({
    type: "GET",
    contentType: "application/json",
    url: '../../web_services/assistants/getInfoAssistant.php',
    data: {
      "controlnumber": $control
    },
    success: function (result) {
      $('#input-control-number').prop("value", $control);
      $('#input-name').prop("value", result.data[0].name);
      $('#input-paternal_surname').prop("value", result.data[0].paternal_surname);
      $('#input-maternal_surname').prop("value", result.data[0].maternal_surname);
      $('#input-email').prop("value", result.data[0].email);
      $("#input-id_career option[value='"+result.data[0].id_career+"']").prop('selected', true);
    },
    error: function(result){
    }
  });
}