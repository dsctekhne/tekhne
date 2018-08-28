$(document).ready(function() {
  $('#input-control-number').keyup(function() {
    // Verify control number length
    if($('#input-control-number').val().toString().length != 8) {
      $('#button-signup').prop("disabled", true);
      $('#help-control-number-signup').addClass('is-danger');
      $('#help-control-number-signup').html('El número de control debe ser de 8 dígitos');
    } else {
      // Verify previous assistants
      $.ajax({
        type: "GET",
        contentType: "application/json",
        url: 'web_services/assistants/getControlNumber.php',
        data: {
          "controlnumber": parseInt($('#input-control-number').val())
        },
        success: function (result) {
          if(result.message == "found") {
            $('#help-control-number-signup').html('El número de control ya está resgitrado');
            $('#help-control-number-signup').addClass('is-danger');
            $('#button-signup').prop("disabled", true);
          } else {
            $('#help-control-number-signup').html('');
            $('#button-signup').prop("disabled", false);
          }
        },
        error: function(result){
          alert(result.message);
        }
      });
      
    }
  });
  $('#reveal-password').click(function() {
    var x = document.getElementById("password-signup");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
  });
});