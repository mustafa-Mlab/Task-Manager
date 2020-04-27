$(document).ready(function(){
  // datePicker
  $.fn.datepicker.setDefaults({
    autoShow: true,
    autoHide: true,
    format: 'yyyy-mm-dd',
  });

  // add task
  $('#date-picker').on('click', function(){
    $('[data-toggle="datepicker"]').datepicker();
  });


  // complete
  $('.task-complete').on('click', function(){
    let id = $(this).data('taskid');
    $('#complete-data').val(id);
    $('#complete-form').submit();
  });

  // delete
  $('.delete-task').on('click', function(){
    if(confirm('Are you sure to delete this task?')){
      let id = $(this).data('taskdelete');
      $('#delete-data').val(id);
      $('#delete-form').submit();
    }
  });

  // mark incomplete
  $('.task-incomplete').on('click', function(){
    let id = $(this).data('taskincomplete');
    $('#incomplete-data').val(id);
    $('#inomplete-form').submit();
  });

  //bulkdelete
  $('#bulksubmit').on('click', function(){
    if( $('#bulkaction').val() == 'bulkdelete' ){
      if( !confirm('Are you sure to delete?') ){
        return false;
      }
    }
  });

  //register
  $("#register").on('click', function(){
    $(".login-title").html("REGISTRATION");
    $("#action").val("registration");
  });

  //login
  $("#login").on('click', function(){
    $(".login-title").html("LOGIN");
    $("#action").val("login");
  });

});