$(function(){

  $('#employee-table').DataTable({
    "responsive": true,
    "scrollY": "50vh",
    "scrollCollapse": true, 
    "paging": false,
    "info": false,
  });

  triggerClick = (e) => {
    $('#profileImage').click();
  }
  displayImage = (e) => {
    if (e.files[0]) {
      var reader = new FileReader();
        reader.onload = function(e){
        $('#profileDisplay').attr('src', e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
    }
  }

  // $(".profileDisplayEdit").on('click', function(){
  //   var id = $(this).attr("data-id");
  //   $('#profileImageEdit-'+id).click();
  // })
  
  $(".profileImageEdit").on('change', function(){
    var id = $(this).attr("data-id");
    // alert(id);
    if (e.files[0]) {
      var reader = new FileReader();
        reader.onload = function(e){
        $('#profileDisplayEdit-'+id).attr('src', e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
    }
  });

  $('.btn-clear').click(() => {
    var id = $('.modal-body').attr('data-id');
    $('#profileDisplay').attr('src', 'assets/images/attach.png');
    $('#profileDisplayEdit-'+id).attr('src', 'assets/images/attach.png');
    $("#position").prop("disabled", true);
  })

  $('#department').change(function() {
    positionClick()
    if ($(this).val() != "") {
      $("#position").prop("disabled", false);
      $("#position").focus();
      $("#position").html(
        "<option value='' selected disabled>Select position</option>"
      );
    } else {
      $("#position").prop("disabled", true);
    }
  });

  function positionClick() {
    $('#position').one('click', (e) => {
      e.preventDefault();
      var department_id = $('#department').val();
      $.ajax({
        url: 'queries/get_positions.php',
        type: 'POST',
        data: {
          department_id: department_id
        },
        success: function(data) {
          $('#position').append(data);
        }
      });
    });
  }
});


