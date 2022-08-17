<?php
    if(!isset($_SESSION)){
      session_start();
    }

    if(isset($_GET['delete'])){

      $emp_id = $_GET['delete'];
      $sql = "DELETE FROM `emp_tbl` WHERE `emp_id` = '$emp_id'";
      if($con->query($sql) === TRUE){
        $_SESSION['message'] = 
        "<script>
          Swal.fire({
            toast: true,
            position: 'top',
            icon: 'success',
            title: 'Successfully Deleted',
            showConfirmButton: false,
            timer: 2000
          }).then((result) => {
            window.history.replaceState( null, null, window.location.href );
          })
        </script>";
        echo header("Refresh:2; url=index.php");
      } else {
        $_SESSION['message'] = 
        "<script>
        Swal.fire({
          toast: true,
          position: 'top',
          icon: 'error',
          title: 'Error Deleting Employee',
          showConfirmButton: false,
          timer: 2000
        }).then((result) => {
          window.history.replaceState( null, null, window.location.href );
        })
        </script>";
        echo header("Refresh:2; url=index.php");
      }
    }