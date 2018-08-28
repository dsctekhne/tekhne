$(document).ready(function() {
  var isMobile = window.matchMedia("only screen and (max-width: 760px)");
    if (!isMobile.matches) {
      $('.event').on({
        "mouseover" : function() {
           $(this).find('.event-image').attr('src', 'images/tickets_hover.png');
           $(this).addClass('has-text-white');
           $(this).find('.btn-event').removeClass('is-primary');
           $(this).find('.btn-event').addClass('is-light');
         },
         "mouseout" : function() {
          $(this).find('.event-image').attr('src', 'images/tickets_normal.png');
          $(this).removeClass('has-text-white');
          $(this).find('.btn-event').removeClass('is-light');
          $(this).find('.btn-event').addClass('is-primary');
         }
       });
       $('.event-workshop').on({
        "mouseover" : function() {
           $(this).find('.event-image').attr('src', 'images/tickets_hover.png');
           $(this).addClass('has-text-white');
           $(this).find('.btn-event').removeClass('is-info');
           $(this).find('.btn-event').addClass('is-light');
         },
         "mouseout" : function() {
          $(this).find('.event-image').attr('src', 'images/tickets_workshop.png');
          $(this).removeClass('has-text-white');
          $(this).find('.btn-event').removeClass('is-light');
          $(this).find('.btn-event').addClass('is-info');
         }
       });
    }
  
});