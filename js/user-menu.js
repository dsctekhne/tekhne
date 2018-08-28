$(document).ready(function() {
  var active = 0;
  $('#user-icon-menu').click(function() {
    if(active == 0) {
      $('#user-icon-menu').addClass('is-active');
      
      active = 1;
    } else if(active == 1) {
      $('#user-icon-menu').removeClass('is-active');
      active = 0;
    }
  });
  var active_desktop = 0;
  $('#user-icon-desktop').click(function() {
    if(active_desktop == 0) {
      $('#user-icon-desktop').addClass('is-active');
      active_desktop = 1;
    } else if(active_desktop == 1) {
      $('#user-icon-desktop').removeClass('is-active');
      active_desktop = 0;
    }
  });
});