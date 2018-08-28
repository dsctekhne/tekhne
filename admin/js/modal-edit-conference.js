$(document).ready(function() {
  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false,
    minuteStep: 5,
    showMeridian: false
  })
  //Date picker
  $('#datepicker').datepicker({
    autoclose: true,
    orientation: 'bottom',
    format: 'yyyy/mm/dd',
  })
  var id_conference;
  $('.button-edit').click(function() {
    id_conference = $(this).prop('id');
    showEditModal($(this).prop('id')); 
  });
  $('form').submit(function(e) {
    $.ajax({
      type: "GET",
      contentType: "application/json",
      url: '../../web_services/conferences/editConferenceService.php',
      data: {
        'id_conference' : $('#input-id_conference').val().toString(),
        'title' : $('#input-title').val().toString(),
        'hour' : $('#input-hour').val().toString(),
        'date' : $('#datepicker').val(),
        'place' : $('#input-place').val().toString(),
        'id_speaker' : $('#input-id_speaker option:selected').val().toString(),
      },
      success: function (result) {
        $('#modal-edit-conference').modal('toggle');
        $.ajax({
          async: true,
          url: '../views/editConference.php'
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

function showEditModal($id_conference) {
  $.ajax({
    type: "GET",
    contentType: "application/json",
    url: '../../web_services/conferences/getInfoConferenceService.php',
    data: {
      "id_conference": $id_conference
    },
    success: function (result) {
      $('#input-id_conference').prop("value", $id_conference);
      $('#input-title').prop("value", result.data[0].title);
      $('#input-hour').prop("value", result.data[0].hour);
      $('#datepicker').prop("value", result.data[0].date);
      $('#input-place').prop("value", result.data[0].place);
      $("#input-id_speaker option[value='"+result.data[0].id_speaker+"']").prop('selected', true);
    },
    error: function(result){
    }
  });
}