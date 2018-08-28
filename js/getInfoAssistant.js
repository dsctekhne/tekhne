function getInfo($control) {
  $.ajax({
    type: "GET",
    contentType: "application/json",
    url: 'web_services/assistants/getInfoAssistant.php',
    data: {
      "controlnumber": $control
    },
    success: function (result) {
      $('#assistant-data-navbar').html('<i class="fas fa-user-circle"></i>&nbsp&nbsp&nbsp' + result.data[0].name);
    },
    error: function(result){
    }
  });
}
