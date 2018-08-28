$(document).ready(function() {
  $('#form-list-conference').submit(function(e) {
    e.preventDefault();
    $('#conference-info').empty();
    $.ajax({
      type: "GET",
      contentType: "application/json",
      url: '../../web_services/assistants/getAllConferenceInfo.php',
      data: {
        "id_conference": $('#input-id_conference option:selected').val()
      },
      success: function (result) {
        if(result.message != 'not found') {
          var output = '';
          for (let i = 0; i < result.data.length; i++) {
            output += 
            '<tr>'+
                '<td>'+
                  result.data[i].id_conference+
                '</td>'+
                '<td>'+
                  result.data[i].title+
                '</td>'+
                '<td>'+
                  result.data[i].control_number+
                '</td>'+
                '<td>'+
                  result.data[i].name+
                '</td>';
            if(result.data[i].status == 0) {
              output +=
                '<td style="color:red;">'+
                  '<span class="label label-danger">No Registrado</span>'+
                '</td>'+
              '</tr>'
            } else {
              output +=
                '<td>'+
                  '<span class="label label-success">Registrado</span>'+
                '</td>'+
              '</tr>'
            }
          }
          $('#conference-info').append(
            '<div class="box-body table-responsive">'+
              '<table id="table-conferences" class="table table-bordered table-hover text-center">'+
                '<thead>'+
                  '<tr>'+
                    '<th>ID Conferencia</th>'+
                    '<th>Título</th>'+
                    '<th>Número de Control</th>'+
                    '<th>Nombre del Asistente</th>'+
                    '<th>Estatus</th>'+
                  '</tr>'+
                '</thead>'+
                '<tbody id="conference-info">'+
                output+
                '</tbody>'+
              '</table>'+
            '</div>'
          );
          $('#table-conferences').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
          })  
        } else {
          $('#conference-info').append(
            '<h4 class="text-center text-muted">'+
              'Aún no hay estudiantes registrados.'+
            '</h4>'
          )
        }
      },
      error: function(result){
        alert('dsad');
        $('#conference-info').append(
          '<h4 class="text-center text-muted">'+
            'Aún no hay estudiantes registrados'+
          '</h4>'
        )
      }
    });
    e.preventDefault();
  });
});