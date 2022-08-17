<?php

  if(!isset($_SESSION)){
    session_start();
  }

  if(isset($_POST['btn-add-employee'])){
    date_default_timezone_set('Asia/Manila');
    $time=time();

    $photo = $time.'_'.$_FILES['profileImage']['name'];
    $fileLocation = "assets/images/uploads/".$photo;

    $name = $_POST['emp_name'];
    $email = $_POST['emp_email'];
    $department_id = $_POST['emp_dept'];
    $position_id = $_POST['emp_position'];

    $sql = "INSERT INTO `emp_tbl` (`emp_name`, `emp_photo`, `emp_email`, `status`, `department_id`, `position_id`) VALUES ('$name', '$photo', '$email', 'Active', '$department_id', '$position_id')";

    move_uploaded_file($_FILES["profileImage"]["tmp_name"], $fileLocation);

    if($con->query($sql) === TRUE){
      $_SESSION['message'] = 
      "<script>
        Swal.fire({
          toast: true,
          position: 'top',
          icon: 'success',
          title: 'Successfully Added',
          showConfirmButton: false,
          timer: 2000
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
        title: 'Error Adding Employee',
        showConfirmButton: false,
        timer: 2000
      })
      window.history.replaceState( null, null, window.location.href );
    </script>";
    }
  }

  // <script>
  //   Swal.fire();
  // </script>