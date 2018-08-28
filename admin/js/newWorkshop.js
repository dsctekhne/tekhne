$(document).ready(function() {
  var schedule_count = 1;
  verifyDeleteSchedule(schedule_count);
  addFunctionality();
  $('#btn-add-schedule').click(function(e) {
    e.preventDefault();
    $('#schedule-adds').append(
      '<div class="text-primary day-schedule" id="day-'+(++schedule_count)+'">'+
        '<h5>Horario '+(schedule_count)+':</h5>'+
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
    verifyDeleteSchedule(schedule_count);
  });

  $('#btn-delete-last-schedule').click(function(e) {
    e.preventDefault();
    $('#day-'+(schedule_count--)).remove();
    verifyDeleteSchedule(schedule_count);
  });

  $('form').submit(function(e) {
    e.preventDefault();
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
      url: '../../web_services/workshops/newWorkshopService.php',
      data: {
        "title" : $('#input-title').val(),
        "capacity" : $('#input-quota').val(),
        "id_instructor" : $('#input-id_instructor option:selected').val(),
        "schedule" : JSON.stringify(json_schedules)
      },
      success: function (result) {
        $.ajax({
          async: true,
          url: '../views/editWorkshop.php'
        }).done(function(data) { // data what is sent back by the php page 
          $('.content-wrapper').html(data);
        });
      },
      error: function(result){
        $.ajax({
          async: true,
          url: '../views/dashboard.php'
        }).done(function(data) { // data what is sent back by the php page 
          $('.content-wrapper').html(data);
        });
      }
    });
    
  });
});

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