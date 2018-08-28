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
});