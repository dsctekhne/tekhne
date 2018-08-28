$(document).ready(function() {
  var id_speaker;
  $('.button-edit').click(function() {
    id_speaker = $(this).prop('id');
    showEditModal($(this).prop('id')); 
  });
  $('form').submit(function(e) {
    $.ajax({
      type: "GET",
      contentType: "application/json",
      url: '../../web_services/speakers/editSpeakerService.php',
      data: {
        "id_speaker" : id_speaker,
        "name" : $('#input-name').val().toString(),
        "paternal_surname" : $('#input-paternal_surname').val().toString(),
        "maternal_surname" : $('#input-maternal_surname').val().toString(),
        "information" : $('#input-information').val().toString(),
      },
      success: function (result) {
        $('#modal-edit-speaker').modal('toggle');
        $.ajax({
          async: true,
          url: '../views/editSpeaker.php'
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

function showEditModal($id_speaker) {
  $.ajax({
    type: "GET",
    contentType: "application/json",
    url: '../../web_services/speakers/getInfoSpeakerService.php',
    data: {
      "id_speaker": $id_speaker
    },
    success: function (result) {
      $('#input-id_speaker').prop("value", $id_speaker);
      $('#input-name').prop("value", result.data[0].name);
      $('#input-paternal_surname').prop("value", result.data[0].paternal_surname);
      $('#input-maternal_surname').prop("value", result.data[0].maternal_surname);
      $('#input-information').prop("value", result.data[0].information);
    },
    error: function(result){
    }
  });
}