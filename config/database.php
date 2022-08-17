<?php
  function get_db_config()
  {
    $db_host = "localhost";
    $db_name = "emp_db";
    $db_user = "root";
    $db_pass = "";

    $con = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
    } else {
      return $con;
    }
  }