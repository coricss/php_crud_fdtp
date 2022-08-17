<?php
  if(!isset($_SESSION)){
    session_start();
  }

  if(isset($_POST['btn-update-employee'])){
    $name = $_POST['emp_name_edit'];
    $email = $_POST['emp_email_edit'];
    $department_id = $_POST['emp_dept_edit'];
    $position_id = $_POST['emp_position_edit'];
    $emp_id = $_POST['emp_id_edit'];

    $sql = "UPDATE `emp_tbl` SET `emp_name` = '$name', `emp_email` = '$email', `department_id` = '$department_id', `position_id` = '$position_id' WHERE `emp_id` = '$emp_id'";

    if($con->query($sql) === TRUE){
      $_SESSION['message'] = 
      "<script>
        Swal.fire({
          toast: true,
          position: 'top',
          icon: 'success',
          title: 'Successfully Updated',
          showConfirmButton: false,
          timer: 2000
        }).then((result) => {
          location.reload()
        })
        window.history.replaceState( null, null, window.location.href );
      </script>";
    } else {
      $_SESSION['message'] = 
      "<script>
      Swal.fire({
        toast: true,
        position: 'top',
        icon: 'error',
        title: 'Error Updating Employee',
        showConfirmButton: false,
        timer: 2000
      }).then((result) => {
        location.reload()
      })
      window.history.replaceState( null, null, window.location.href );
    </script>";
    }
  } 