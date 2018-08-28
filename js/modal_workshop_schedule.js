$(document).ready(function() {
  $('.button-modal_schedule').click(function() {
    $('#schedule-info').empty();
    $.ajax({
      type: "GET",
      contentType: "application/json",
      url: 'web_services/workshops/getScheduleService.php',
      data: {
        'id_workshop' : $(this).prop('id'),
      },
      success: function (result) {
        var output =
          '<table class="table" style="width:100%;">'+
            '<thead class="">'+
              '<tr>'+
                '<th >Fecha:</th>'+
                '<th >Hora de inicio:</th>'+
                '<th >Hora de termino:</th>'+
                '<th >Ubicación:</th>'+
              '</tr>'+
            '</thead>'+
            '<tbody>';
        for (let i = 0; i < result.data.length; i++) {
          output += 
            '<tr>'+
              '<td>'+
                result.data[i].date+
              '</td>'+
              '<td>'+
                result.data[i].hour_start+
              '</td>'+
              '<td>'+
                result.data[i].hour_end+
              '</td>'+
              '<td>'+
                result.data[i].place+
              '</td>'+
            '</tr>';
        }
        output +=
          '</tbody>'+
          '</table>';
        $('#schedule-info').append(output);
      },
      error: function(result){
        $('#notifications').html("Ha ocurrido un error.");
      }
    });
    $("html").addClass("is-clipped");
    $('#modal_workshop_schedule').addClass('is-active');
  });
  $('#button-close-mod-w').click(function() {
      $("html").removeClass("is-clipped");
      $('#modal_workshop_schedule').removeClass('is-active');
  });
});