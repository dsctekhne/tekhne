$(document).ready(function() {
  var id_workshop;
  $('#btn-add-schedule').click(function(e) {
    e.preventDefault();
    $('#schedule-adds').append(
      '<div class="text-primary day-schedule" id="day-'+(incCount())+'">'+
        '<h5>Horario '+(localStorage.getItem('schedule_count'))+':</h5>'+
        '<div class="bootstrap-timepicker">' +
          '<div class="form-group">' +
            '<label for="hour">Hora de inicio:</label>' +
            '<div class="input-group">' +
              '<span class="input-group-addon"><i class="fas fa-clock"></i></span>' +
              '<input type="text" class="form-control timepicker input-hour_start"' +
              'placeholder="Hora de inicio del taller"' +
              'maxlength="50" required="required">' +
            '</div>'+
          '</div>'+
        '</div>'+
        '<div class="bootstrap-timepicker">'+
          '<div class="form-group">'+
            '<label for="hour">Hora de termino:</label>'+
            '<div class="input-group">'+
              '<span class="input-group-addon"><i class="fas fa-clock"></i></span>'+
              '<input type="text" class="form-control timepicker input-hour_end" '+
              'placeholder="Hora de inicio de la conferencia"'+
              'maxlength="50" required="required">'+
            '</div>'+
          '</div>'+
        '</div>'+
        '<div class="form-group">'+
          '<label for="date">Fecha:</label>'+
          '<div class="input-group date">'+
          '<div class="input-group-addon">'+
            '<i class="fa fa-calendar"></i>'+
          '</div>'+
            '<input type="text" class="form-control pull-right input-date datepicker" '+
            'required="required" class="form-control"'+
            'placeholder="Introduce la fecha del taller">'+
          '</div>'+
        '</div>'+
        '<div class="form-group">'+
          '<label for="place">Ubicación del taller:</label>'+
          '<div class="input-group">'+
            '<span class="input-group-addon"><i class="fas fa-map-marker"></i></span>'+
            '<input type="text" class="form-control input-place" '+
            'placeholder="Ubicación donde será el taller"'+
            'maxlength="50" required="required" name="place">'+
          '</div>'+
        '</div>'+
      '</div>'
    );
    addFunctionality();
    verifyDeleteSchedule(localStorage.getItem('schedule_count'));
  });

  $('#btn-delete-last-schedule').click(function(e) {
    e.preventDefault();
    $('#day-'+(localStorage.getItem('schedule_count'))).remove();
    decCount();
    verifyDeleteSchedule(localStorage.getItem('schedule_count'));
  });
  $('.button-edit').click(function() {
    id_workshop = $(this).prop('id');
    showEditModal($(this).prop('id')); 
  });
  $('form').submit(function(e) {
    // JSON of schedules
    var json_schedules = [];
    var i = 0;
    $('.day-schedule').each(function() {
      var schedule = [];
      schedule.push({
        hour_start : $(this).find('.input-hour_start').val(),
        hour_end : $(this).find('.input-hour_end').val(),
        date : $(this).find('.input-date').val(),
        place : $(this).find('.input-place').val().toUpperCase()
      });
      
      json_schedules.push({
        day : schedule
      });
    });
    $.ajax({
      type: "GET",
      contentType: "application/json",
      url: '../../web_services/workshops/editWorkshopService.php',
      data: {
        'id_workshop' : $('#input-id_workshop').val().toString(),
        'title' : $('#input-title').val().toString(),
        'quota' : $('#input-quota').val().toString(),
        'id_instructor' : $('#input-id_instructor option:selected').val().toString(),
        "schedule" : JSON.stringify(json_schedules)
      },
      success: function (result) {
        $('#modal-edit-workshop').modal('toggle');
        $.ajax({
          async: true,
          url: '../views/editWorkshop.php'
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

function showEditModal($id_workshop) {
  $.ajax({
    type: "GET",
    contentType: "application/json",
    url: '../../web_services/workshops/getInfoWorkshopService.php',
    data: {
      "id_workshop": $id_workshop
    },
    success: function (result) {
      $.ajax({
        type: "GET",
        contentType: "application/json",
        url: '../../web_services/workshops/getScheduleService.php',
        data: {
          "id_workshop": $id_workshop
        },
        success: function (result2) {
          $('#input-id_workshop').prop("value", $id_workshop);
          $('#input-title').prop("value", result.data[0].title);
          $('#input-quota').prop("value", result.data[0].quota);
          $("#input-id_instructor option[value='"+result.data[0].id_instructor+"']").prop('selected', true);
          for (let i = 0; i < result2.data.length; i++) {
            $('#schedule-adds').append(
              '<div class="text-primary day-schedule" id="day-'+(i+1)+'">'+
                '<h5>Horario '+(i+1)+':</h5>'+
                '<div class="bootstrap-timepicker">' +
                  '<div class="form-group">' +
                    '<label for="hour">Hora de inicio:</label>' +
                    '<div class="input-group">' +
                      '<span class="input-group-addon"><i class="fas fa-clock"></i></span>' +
                      '<input type="text" class="form-control timepicker input-hour_start"' +
                      'placeholder="Hora de inicio del taller"' +
                      'maxlength="50" required="required"'+
                      'value="'+(result2.data[i].hour_start)+'">' +
                    '</div>'+
                  '</div>'+
                '</div>'+
                '<div class="bootstrap-timepicker">'+
                  '<div class="form-group">'+
                    '<label for="hour">Hora de termino:</label>'+
                    '<div class="input-group">'+
                      '<span class="input-group-addon"><i class="fas fa-clock"></i></span>'+
                      '<input type="text" class="form-control timepicker input-hour_end" '+
                      'placeholder="Hora de inicio de la conferencia"'+
                      'maxlength="50" required="required"'+
                      'value="'+(result2.data[i].hour_end)+'">'+
                    '</div>'+
                  '</div>'+
                '</div>'+
                '<div class="form-group">'+
                  '<label for="date">Fecha:</label>'+
                  '<div class="input-group date">'+
                  '<div class="input-group-addon">'+
                    '<i class="fa fa-calendar"></i>'+
                  '</div>'+
                    '<input type="text" class="form-control pull-right input-date datepicker" '+
                    'required="required" class="form-control"'+
                    'placeholder="Introduce la fecha del taller"'+
                    'value="'+(result2.data[i].date)+'">' +
                  '</div>'+
                '</div>'+
                '<div class="form-group">'+
                  '<label for="place">Ubicación del taller:</label>'+
                  '<div class="input-group">'+
                    '<span class="input-group-addon"><i class="fas fa-map-marker"></i></span>'+
                    '<input type="text" class="form-control input-place" '+
                    'placeholder="Ubicación donde será el taller"'+
                    'maxlength="50" required="required" name="place"'+
                    'value="'+(result2.data[i].place)+'">' +
                  '</div>'+
                '</div>'+
              '</div>'
            );
            addFunctionality();
            verifyDeleteSchedule(result2.data.length);
            localStorage.setItem("schedule_count", result2.data.length);
          }
        },
        error: function(result){
        }
      });
      $('#input-id_workshop').prop("value", $id_workshop);
      $('#input-title').prop("value", result.data[0].title);
      $('#input-quota').prop("value", result.data[0].quota);
      $("#input-id_instructor option[value='"+result.data[0].id_instructor+"']").prop('selected', true);
    },
    error: function(result){
    }
  });
}
function verifyDeleteSchedule(schedule_count){
  if(schedule_count == 1) {
    $('#btn-delete-last-schedule').css("display", "none");
  } else {
    $('#btn-delete-last-schedule').css("display", "block");
  }
}
function addFunctionality() {
  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false,
    minuteStep: 5,
    showMeridian: false
  })
  //Date picker
  $('.datepicker').datepicker({
    autoclose: true,
    orientation: 'bottom',
    format: 'yyyy/mm/dd',
  })
}

function incCount() {
  var num = parseInt(localStorage.getItem('schedule_count'));
  num++;
  console.log(num);
  localStorage.setItem('schedule_count', num);
  return localStorage.getItem('schedule_count');
}

function decCount() {
  var num = parseInt(localStorage.getItem('schedule_count'));
  num--;
  console.log(num);
  localStorage.setItem('schedule_count', num);
  return localStorage.getItem('schedule_count');
}