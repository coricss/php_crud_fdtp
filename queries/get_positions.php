<?php
  include('./../config/database.php');
  $con = get_db_config();

  extract($_POST);

  $sql_position = $con->query("SELECT * FROM `positions_tbl` WHERE `department_id` = '$department_id' ORDER BY `position_id` ASC");

  if ($sql_position->num_rows > 0) {
    while ($row = $sql_position->fetch_array()) {
      echo "<option value='".$row['position_id']."'>".$row['position_name']."</option>";
    }
  } else {
    echo "<option value=''>No Position</option>";
  }
