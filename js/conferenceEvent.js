$(document).ready(function() {
  $('.btn-event').click(function() {
    var event_type = $(this).prop('id').charAt(0);
    var control_number =  $(this).prop('id').split('-')[1].toString();
    if(event_type == 'c') {
      $.ajax({
        type: "GET",
        contentType: "application/json",
        url: 'web_services/assistants/isRegisteredConferences.php',
        data: {
          "control_number": control_number
        },
        success: function (result) {
          if(result.message == "found")
            alert('¡Ya estabas registrado!');
          else {
            $.ajax({
              type: "GET",
              contentType: "application/json",
              url: 'web_services/assistants/registerConferencesService.php',
              data: {
                "control_number": control_number
              },
              success: function (result) {
                window.location = "yourconferences.php"
              },
              error: function(result){
              }
            });
          }
        },
        error: function(result){
        }
      });
    } else if (event_type == 't') {
      var id_workshop = $(this).prop('id').split('-')[0].substring(1).toString();
      $.ajax({
        type: "GET",
        contentType: "application/json",
        url: 'web_services/assistants/isRegisteredWorkshop.php',
        data: {
          "control_number" : control_number,
          "id_workshop" : id_workshop
        },
        success: function (result) {
          if(result.message == "found")
            alert('¡Ya estabas registrado!');
          else {
            $.ajax({
              type: "GET",
              contentType: "application/json",
              url: 'web_services/assistants/registerWorkshopService.php',
              data: {
                "control_number" : control_number,
                "id_workshop" : id_workshop
              },
              success: function () {
                window.location = "yourworkshops.php"
              },
              error: function(){
              }
            });
          }
        },
        error: function(){
        }
      });
    }
  });
});