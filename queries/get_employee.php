<?php

    $sql = "SELECT * FROM `emp_tbl` INNER JOIN `positions_tbl` ON `emp_tbl`.`position_id` = `positions_tbl`.`position_id` INNER JOIN `department_tbl` ON `emp_tbl`.`department_id` = `department_tbl`.`department_id`";

    $result = $con->query($sql);

    $edit = $con->query($sql);

    