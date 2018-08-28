$(document).ready(function() {
  $('.button-sign-in').click(function() {
    $("html").addClass("is-clipped");
    $('#modal_signin').addClass('is-active');
  });
  $('#button-close-modal-signin').click(function() {
      $("html").removeClass("is-clipped");
      $('#modal_signin').removeClass('is-active');
  });
});