$(document).ready(function() {
  var id_instructor;
  $('.button-edit').click(function() {
    id_instructor = $(this).prop('id');
    showEditModal($(this).prop('id')); 
  });
  $('form').submit(function(e) {
    $.ajax({
      type: "GET",
      contentType: "application/json",
      url: '../../web_services/instructors/editInstructorService.php',
      data: {
        "id_instructor" : id_instructor,
        "name" : $('#input-name').val().toString(),
        "paternal_surname" : $('#input-paternal_surname').val().toString(),
        "maternal_surname" : $('#input-maternal_surname').val().toString(),
        "information" : $('#input-information').val().toString(),
      },
      success: function (result) {
        $('#modal-edit-instructor').modal('toggle');
        $.ajax({
          async: true,
          url: '../views/editInstructor.php'
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

function showEditModal($id_instructor) {
  $.ajax({
    type: "GET",
    contentType: "application/json",
    url: '../../web_services/instructors/getInfoInstructorService.php',
    data: {
      "id_instructor": $id_instructor
    },
    success: function (result) {
      $('#input-id_instructor').prop("value", $id_instructor);
      $('#input-name').prop("value", result.data[0].name);
      $('#input-paternal_surname').prop("value", result.data[0].paternal_surname);
      $('#input-maternal_surname').prop("value", result.data[0].maternal_surname);
      $('#input-information').prop("value", result.data[0].information);
    },
    error: function(result){
    }
  });
}