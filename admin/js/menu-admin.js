$(document).ready(function() {
  $('#btn-edit-assistant').click(function() {
    $.ajax({
      url: '../views/editAssistant.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-delete-assistant').click(function() {
    $.ajax({
      url: '../views/deleteAssistant.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-new-instructor').click(function() {
    $.ajax({
      url: '../views/newInstructor.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-edit-instructor').click(function() {
    $.ajax({
      url: '../views/editInstructor.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-delete-instructor').click(function() {
    $.ajax({
      url: '../views/deleteInstructor.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-new-speaker').click(function() {
    $.ajax({
      url: '../views/newSpeaker.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-edit-speaker').click(function() {
    $.ajax({
      url: '../views/editSpeaker.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-delete-speaker').click(function() {
    $.ajax({
      url: '../views/deleteSpeaker.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-list-conferences').click(function() {
    $.ajax({
      url: '../views/listConferences.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-new-conference').click(function() {
    $.ajax({
      url: '../views/newConference.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-edit-conference').click(function() {
    $.ajax({
      url: '../views/editConference.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-delete-conference').click(function() {
    $.ajax({
      url: '../views/deleteConference.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('.btn-list-workshops').click(function() {
    $.ajax({
      url: '../views/listWorkshops.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-new-workshop').click(function() {
    $.ajax({
      url: '../views/newWorkshop.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-edit-workshop').click(function() {
    $.ajax({
      url: '../views/editWorkshop.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-delete-workshop').click(function() {
    $.ajax({
      url: '../views/deleteWorkshop.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-pdf-workshop').click(function() {
    $.ajax({
      url: '../views/listAssistantsWorkshop.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-excel-workshop').click(function() {
    $.ajax({
      url: '../views/listAssistantsWorkshopExcel.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  $('#btn-excel-conferences').click(function() {
    $.ajax({
      url: '../views/listAssistantsConferencesExcel.php'
    }).done(function(data) { // data what is sent back by the php page
      $('.content-wrapper').html(data); // display data
    });
  });
  // $('.treeview').click(function() {
  //   $('.treeview').removeClass('active');
  //   $(this).addClass('active');
  // });
});