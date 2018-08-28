$(document).ready(function() {
  // $('#control-number-login').keyup(function() {
  //   if($('#control-number-login').val().toString().length > 8)
  //     $('#button-login').prop("disabled", true);
  //   else 
  //     $('#button-login').prop("disabled", false);
  //   $.ajax({
  //     type: "GET",
  //     contentType: "application/json",
  //     url: 'http://localhost/tekhne/web_services/assistants/getControlNumber.php',
  //     data: {
  //       "controlnumber": $('#control-number-login').val()
  //     },
  //     success: function (result) {
  //       if(result.message == "found") {
  //         $('#help-control-login').html('¡El número de control es correcto!');
  //         $('#help-control-login').removeClass('is-danger');
  //         $('#help-control-login').addClass('is-primary');
  //       } else {
  //         $('#help-control-login').html('¡Número de control no registrado!');
  //         $('#help-control-login').removeClass('is-primary');
  //         $('#help-control-login').addClass('is-danger');
  //       }
  //     },
  //     error: function(result){
  //     }
  //   });
  // });
});